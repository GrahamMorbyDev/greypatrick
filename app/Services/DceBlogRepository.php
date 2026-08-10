<?php

namespace App\Services;

use App\Data\DceBlogPost;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class DceBlogRepository
{
    public function paginate(int $perPage = 9, ?int $page = null): LengthAwarePaginator
    {
        $page ??= LengthAwarePaginator::resolveCurrentPage();
        $posts = $this->all();

        return new LengthAwarePaginator(
            items: $posts->forPage($page, $perPage)->values(),
            total: $posts->count(),
            perPage: $perPage,
            currentPage: $page,
            options: [
                'path' => route('blog.index'),
                'pageName' => 'page',
            ],
        );
    }

    public function findBySlug(string $slug): ?DceBlogPost
    {
        return $this->all()->first(fn (DceBlogPost $post): bool => $post->slug === $slug);
    }

    /**
     * @return Collection<int, DceBlogPost>
     */
    public function all(): Collection
    {
        if (app()->runningUnitTests()) {
            return $this->fetch();
        }

        return Cache::remember(
            key: 'dce.blogs.'.md5($this->endpoint()),
            ttl: now()->addMinutes((int) config('services.dce.blogs_cache_minutes', 30)),
            callback: fn (): Collection => $this->fetch(),
        );
    }

    /**
     * @return Collection<int, DceBlogPost>
     */
    private function fetch(): Collection
    {
        try {
            $blogs = Http::timeout(8)
                ->acceptJson()
                ->get($this->endpoint())
                ->throw()
                ->collect('blogs');
        } catch (Throwable) {
            return collect();
        }

        return $blogs
            ->filter(fn (mixed $payload): bool => is_array($payload))
            ->map(fn (array $payload): DceBlogPost => DceBlogPost::fromPayload($payload))
            ->filter(fn (DceBlogPost $post): bool => $post->slug !== '')
            ->values();
    }

    private function endpoint(): string
    {
        return (string) config('services.dce.blogs_url');
    }
}
