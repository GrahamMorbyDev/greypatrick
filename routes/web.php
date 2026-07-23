<?php

use App\Http\Controllers\EnquiryController;
use App\Models\BlogPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/robots.txt', function () {
    return response()
        ->view('seo.robots')
        ->header('Content-Type', 'text/plain');
})->name('seo.robots');

Route::get('/sitemap.xml', function () {
    $pages = collect([
        ['loc' => route('home'), 'lastmod' => Carbon::today(), 'changefreq' => 'weekly', 'priority' => '1.0'],
        ['loc' => route('services'), 'lastmod' => Carbon::today(), 'changefreq' => 'monthly', 'priority' => '0.9'],
        ['loc' => route('work'), 'lastmod' => Carbon::today(), 'changefreq' => 'monthly', 'priority' => '0.8'],
        ['loc' => route('blog.index'), 'lastmod' => Carbon::today(), 'changefreq' => 'weekly', 'priority' => '0.7'],
        ['loc' => route('quote'), 'lastmod' => Carbon::today(), 'changefreq' => 'monthly', 'priority' => '0.9'],
        ['loc' => route('contact'), 'lastmod' => Carbon::today(), 'changefreq' => 'monthly', 'priority' => '0.7'],
    ]);

    $posts = BlogPost::query()
        ->where('is_published', true)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->latest('published_at')
        ->get()
        ->map(fn (BlogPost $post): array => [
            'loc' => route('blog.show', $post),
            'lastmod' => $post->updated_at ?? $post->published_at,
            'changefreq' => 'monthly',
            'priority' => '0.6',
        ]);

    $xml = $pages
        ->merge($posts)
        ->map(fn (array $url): string => implode("\n", [
            '  <url>',
            '    <loc>'.e($url['loc']).'</loc>',
            '    <lastmod>'.$url['lastmod']->toDateString().'</lastmod>',
            '    <changefreq>'.$url['changefreq'].'</changefreq>',
            '    <priority>'.$url['priority'].'</priority>',
            '  </url>',
        ]))
        ->implode("\n");

    return response('<?xml version="1.0" encoding="UTF-8"?>'."\n".
        '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n".
        $xml."\n".
        '</urlset>')
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('seo.sitemap');

Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/work', 'pages.work')->name('work');
Route::get('/quote', [EnquiryController::class, 'quote'])->name('quote');
Route::get('/contact', [EnquiryController::class, 'contact'])->name('contact');
Route::get('/blog', function () {
    return view('pages.blog.index', [
        'posts' => BlogPost::query()
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9),
    ]);
})->name('blog.index');

Route::get('/blog/{blogPost:slug}', function (BlogPost $blogPost) {
    abort_unless(
        $blogPost->is_published && $blogPost->published_at !== null && $blogPost->published_at->lte(now()),
        404,
    );

    return view('pages.blog.show', [
        'post' => $blogPost,
    ]);
})->name('blog.show');

Route::post('/quote', [EnquiryController::class, 'submitQuote'])->name('quote.submit');
Route::post('/contact', [EnquiryController::class, 'submitContact'])->name('contact.submit');
