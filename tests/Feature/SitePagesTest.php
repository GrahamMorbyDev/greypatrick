<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_successfully(): void
    {
        $this->fakeDceBlogs();

        $pages = [
            '/' => 'Grey Patrick',
            '/services' => 'Services',
            '/work' => 'Selected Work',
            '/links' => 'Work with Graham',
            '/blog' => 'Blog',
            '/quote' => 'Project Quote',
            '/contact' => 'Contact',
        ];

        foreach ($pages as $path => $text) {
            $this->get($path)
                ->assertOk()
                ->assertSee($text);
        }
    }

    public function test_work_page_shows_real_project_links(): void
    {
        $this->get('/work')
            ->assertOk()
            ->assertSee('Digital Content Engine')
            ->assertSee('Rachel Goodall')
            ->assertSee('BiteSaavy')
            ->assertSee('Chichester 3D Printing')
            ->assertSee('Game Shop Cosham')
            ->assertSee('https://digitalcontentengine.com/', false)
            ->assertSee('https://rachelgoodall.com/', false)
            ->assertSee('https://bitesaavy.com/', false)
            ->assertSee('https://chichester3dprinting.com/', false)
            ->assertSee('https://gameshopcosham.com/', false);
    }

    public function test_homepage_shows_network_ad_banners(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Network Spotlight')
            ->assertSee('Mesh Medic')
            ->assertSee('Digital Content Engine')
            ->assertSee('BiteSaavy')
            ->assertSee('Chichester 3D Printing')
            ->assertSee('https://mesh-medic.com/', false);
    }

    public function test_homepage_has_local_seo_metadata(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('West Sussex Website Design, Laravel &amp; AI Systems', false)
            ->assertSee('West Sussex website design', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('ProfessionalService', false)
            ->assertSee('West Sussex', false);
    }

    public function test_search_files_render(): void
    {
        $this->fakeDceBlogs();

        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('content-type', 'text/plain; charset=UTF-8')
            ->assertSee('Sitemap:', false)
            ->assertSee('/sitemap.xml', false);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('content-type', 'application/xml; charset=UTF-8')
            ->assertSee('<loc>'.route('home').'</loc>', false)
            ->assertSee('<loc>'.route('services').'</loc>', false)
            ->assertSee('<loc>'.route('links').'</loc>', false)
            ->assertSee('<loc>'.route('blog.show', 'dce-blog-1').'</loc>', false)
            ->assertSee('<loc>'.route('quote').'</loc>', false);
    }

    public function test_dce_blog_posts_render_publicly(): void
    {
        $this->fakeDceBlogs();

        $this->get('/blog')
            ->assertOk()
            ->assertSee('DCE Blog 01')
            ->assertSee('https://digitalcontentengine.com/storage/blog-1.webp', false);

        $this->get(route('blog.show', 'dce-blog-1'))
            ->assertOk()
            ->assertSee('DCE Blog 01')
            ->assertSee('Useful DCE post body.', false)
            ->assertSee('DCE SEO Title 1');
    }

    public function test_dce_blog_posts_paginate_nine_per_page(): void
    {
        $this->fakeDceBlogs(count: 10);

        $this->get('/blog')
            ->assertOk()
            ->assertSee('DCE Blog 01')
            ->assertSee('DCE Blog 09')
            ->assertDontSee('DCE Blog 10');

        $this->get('/blog?page=2')
            ->assertOk()
            ->assertSee('DCE Blog 10')
            ->assertDontSee('DCE Blog 01');
    }

    public function test_blog_storage_images_can_be_served_without_public_symlink(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('blog/test-image.jpg', 'fake image content');

        $this->get('/storage/blog/test-image.jpg')
            ->assertOk()
            ->assertSee('fake image content', false);
    }

    private function fakeDceBlogs(int $count = 2): void
    {
        Cache::flush();
        Cache::forget('dce.blogs.'.md5((string) config('services.dce.blogs_url')));

        Http::fake([
            config('services.dce.blogs_url') => Http::response([
                'blogs' => collect(range(1, $count))
                    ->map(fn (int $number): array => [
                        'id' => $number,
                        'campaign_id' => 8,
                        'week_start' => now()->subWeeks($number)->toDateString(),
                        'topic' => 'DCE Topic '.$number,
                        'title' => 'DCE Blog '.str_pad((string) $number, 2, '0', STR_PAD_LEFT),
                        'slug' => 'dce-blog-'.$number,
                        'excerpt' => 'DCE excerpt '.$number,
                        'body_markdown' => '# DCE Blog '.$number."\n\nUseful DCE post body.",
                        'meta' => [
                            'tags' => ['Laravel', 'AI'],
                            'keywords' => ['DCE keyword '.$number],
                            'seo_title' => 'DCE SEO Title '.$number,
                            'seo_description' => 'DCE SEO description '.$number,
                        ],
                        'image' => [
                            'url' => 'https://digitalcontentengine.com/storage/blog-'.$number.'.webp',
                            'alt_text' => 'DCE blog image '.$number,
                        ],
                    ])
                    ->all(),
            ]),
        ]);
    }
}
