<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
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
            ->assertSee('<loc>'.route('quote').'</loc>', false);
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

    public function test_published_blog_posts_without_manual_publish_date_render_publicly(): void
    {
        $post = BlogPost::create([
            'title' => 'Filament Created Post',
            'slug' => 'filament-created-post',
            'post' => '<p>This was created from the admin panel.</p>',
            'author' => 'Grey Patrick',
            'excerpt' => 'A post from Filament.',
            'is_published' => true,
        ]);

        $this->assertNotNull($post->fresh()->published_at);

        $this->get('/blog')
            ->assertOk()
            ->assertSee($post->title);

        $this->get(route('blog.show', $post))
            ->assertOk()
            ->assertSee($post->title);
    }

    public function test_blog_storage_images_can_be_served_without_public_symlink(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('blog/test-image.jpg', 'fake image content');

        $this->get('/storage/blog/test-image.jpg')
            ->assertOk()
            ->assertSee('fake image content', false);
    }
}
