<?php

namespace App\Data;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DceBlogPost
{
    /**
     * @param  array<int, string>  $tags
     * @param  array<int, string>  $keywords
     */
    public function __construct(
        public readonly int $id,
        public readonly string $title,
        public readonly string $slug,
        public readonly ?string $excerpt,
        public readonly string $bodyMarkdown,
        public readonly string $post,
        public readonly string $author,
        public readonly ?Carbon $published_at,
        public readonly ?Carbon $updated_at,
        public readonly ?string $image,
        public readonly ?string $imageAlt,
        public readonly ?string $seoTitle,
        public readonly ?string $seoDescription,
        public readonly array $tags,
        public readonly array $keywords,
    ) {}

    /**
     * @param  array<string, mixed>  $payload
     */
    public static function fromPayload(array $payload): self
    {
        $meta = is_array($payload['meta'] ?? null) ? $payload['meta'] : [];
        $image = is_array($payload['image'] ?? null) ? $payload['image'] : [];
        $bodyMarkdown = (string) ($payload['body_markdown'] ?? '');
        $weekStart = filled($payload['week_start'] ?? null)
            ? Carbon::parse($payload['week_start'])->startOfDay()
            : null;

        return new self(
            id: (int) ($payload['id'] ?? 0),
            title: (string) ($payload['title'] ?? 'Untitled article'),
            slug: (string) ($payload['slug'] ?? Str::slug((string) ($payload['title'] ?? 'article'))),
            excerpt: filled($payload['excerpt'] ?? null) ? (string) $payload['excerpt'] : null,
            bodyMarkdown: $bodyMarkdown,
            post: Str::markdown($bodyMarkdown),
            author: 'Grey Patrick',
            published_at: $weekStart,
            updated_at: $weekStart,
            image: filled($image['url'] ?? null) ? (string) $image['url'] : null,
            imageAlt: filled($image['alt_text'] ?? null) ? (string) $image['alt_text'] : null,
            seoTitle: filled($meta['seo_title'] ?? null) ? (string) $meta['seo_title'] : null,
            seoDescription: filled($meta['seo_description'] ?? null) ? (string) $meta['seo_description'] : null,
            tags: collect($meta['tags'] ?? [])->filter()->map(fn (mixed $tag): string => (string) $tag)->values()->all(),
            keywords: collect($meta['keywords'] ?? [])->filter()->map(fn (mixed $keyword): string => (string) $keyword)->values()->all(),
        );
    }
}
