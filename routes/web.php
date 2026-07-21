<?php

use App\Models\BlogPost;
use App\Models\ContactEnquiry;
use App\Models\QuoteEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/work', 'pages.work')->name('work');
Route::view('/quote', 'pages.quote')->name('quote');
Route::view('/contact', 'pages.contact')->name('contact');
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
    ]);

    QuoteEnquiry::create($validated);

    Mail::raw(view('mail.quote', ['data' => $validated])->render(), function ($message) use ($validated) {
        $message
            ->to('grahampatrickdev@gmail.com')
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
    ]);

    ContactEnquiry::create($validated);

    Mail::raw(view('mail.contact', ['data' => $validated])->render(), function ($message) use ($validated) {
        $message
            ->to('grahampatrickdev@gmail.com')
            ->replyTo($validated['email'], $validated['name'])
            ->subject('New contact enquiry from '.$validated['name']);
    });

    return back()->with('status', 'Message sent. I will get back to you soon.');
})->name('contact.submit');
