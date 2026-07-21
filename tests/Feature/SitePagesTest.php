<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitePagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_successfully(): void
    {
        $pages = [
            '/' => 'Grey Patrick',
            '/services' => 'Services',
            '/work' => 'Selected Work',
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
            ->assertSee('BiteSaavy')
            ->assertSee('Chichester 3D Printing')
            ->assertSee('Game Shop Cosham')
            ->assertSee('https://bitesaavy.com/', false)
            ->assertSee('https://chichester3dprinting.com/', false)
            ->assertSee('https://gameshopcosham.com/', false);
    }

    public function test_published_blog_posts_render_publicly(): void
    {
        $post = BlogPost::create([
            'title' => 'AI Content Systems',
            'slug' => 'ai-content-systems',
            'post' => '<p>Useful post body.</p>',
            'author' => 'Grey Patrick',
            'excerpt' => 'A short summary.',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->get('/blog')
            ->assertOk()
            ->assertSee($post->title);

        $this->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee($post->title)
            ->assertSee('Useful post body.', false);
    }
}
