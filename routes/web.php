<?php

use App\Models\BlogPost;
use App\Models\ContactEnquiry;
use App\Models\QuoteEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

if (! function_exists('enquiry_challenge')) {
    function enquiry_challenge(): array
    {
        $challenge = [
            'left' => random_int(3, 9),
            'right' => random_int(2, 8),
        ];

        $challenge['token'] = hash_hmac(
            'sha256',
            $challenge['left'].'|'.$challenge['right'],
            Config::get('app.key')
        );

        return $challenge;
    }
}

if (! function_exists('validate_enquiry_challenge')) {
    function validate_enquiry_challenge(Request $request): void
    {
        $left = (int) $request->input('human_left');
        $right = (int) $request->input('human_right');
        $expectedToken = hash_hmac('sha256', $left.'|'.$right, Config::get('app.key'));
        $validToken = hash_equals($expectedToken, (string) $request->input('human_token'));
        $validAnswer = (int) $request->input('human_answer') === $left + $right;

        if (! $validToken || ! $validAnswer) {
            throw ValidationException::withMessages([
                'human_answer' => 'Please answer the quick anti-spam question correctly.',
            ]);
        }
    }
}

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
Route::get('/quote', fn () => view('pages.quote', [
    'humanChallenge' => enquiry_challenge(),
]))->name('quote');
Route::get('/contact', fn () => view('pages.contact', [
    'humanChallenge' => enquiry_challenge(),
]))->name('contact');
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

Route::post('/quote', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'project_name' => ['nullable', 'string', 'max:160'],
        'website' => ['nullable', 'url', 'max:255'],
        'project_type' => ['required', 'string', 'max:120'],
        'budget' => ['nullable', 'string', 'max:80'],
        'timeframe' => ['nullable', 'string', 'max:80'],
        'message' => ['required', 'string', 'max:4000'],
        'company_website' => ['prohibited'],
        'human_left' => ['required', 'integer'],
        'human_right' => ['required', 'integer'],
        'human_token' => ['required', 'string'],
        'human_answer' => ['required', 'integer'],
    ]);

    validate_enquiry_challenge($request);

    $validated = collect($validated)
        ->except(['company_website', 'human_left', 'human_right', 'human_token', 'human_answer'])
        ->all();

    QuoteEnquiry::create($validated);

    Mail::raw(view('mail.quote', ['data' => $validated])->render(), function ($message) use ($validated) {
        $message
            ->to(config('mail.to.address'))
            ->replyTo($validated['email'], $validated['name'])
            ->subject('New website quote request from '.$validated['name']);
    });

    return back()->with('status', 'Quote request sent. I will get back to you soon.');
})->name('quote.submit');

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'email' => ['required', 'email', 'max:160'],
        'reason' => ['required', 'string', 'max:120'],
        'message' => ['required', 'string', 'max:4000'],
        'company_website' => ['prohibited'],
        'human_left' => ['required', 'integer'],
        'human_right' => ['required', 'integer'],
        'human_token' => ['required', 'string'],
        'human_answer' => ['required', 'integer'],
    ]);

    validate_enquiry_challenge($request);

    $validated = collect($validated)
        ->except(['company_website', 'human_left', 'human_right', 'human_token', 'human_answer'])
        ->all();

    ContactEnquiry::create($validated);

    Mail::raw(view('mail.contact', ['data' => $validated])->render(), function ($message) use ($validated) {
        $message
            ->to(config('mail.to.address'))
            ->replyTo($validated['email'], $validated['name'])
            ->subject('New contact enquiry from '.$validated['name']);
    });

    return back()->with('status', 'Message sent. I will get back to you soon.');
})->name('contact.submit');
