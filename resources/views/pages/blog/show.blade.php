@extends('layouts.app', [
  'title' => ($post->seoTitle ?? $post->title.' | Grey Patrick'),
  'description' => $post->seoDescription ?? $post->excerpt ?? 'An article by Grey Patrick.',
  'canonical' => route('blog.show', $post->slug),
  'keywords' => filled($post->keywords) ? implode(', ', $post->keywords) : 'Grey Patrick, AI automation, Laravel development, website strategy, business systems, OpenAI workflows, West Sussex web developer',
  'shellClass' => 'content-shell',
  'structuredData' => [
      '@'.'context' => 'https://schema.org',
      '@'.'type' => 'BlogPosting',
      'headline' => $post->title,
      'description' => $post->seoDescription ?? $post->excerpt ?? 'An article by Grey Patrick.',
      'image' => $post->image ?: asset('assets/grey-patrick-workflow-desk.png'),
      'datePublished' => optional($post->published_at)->toIso8601String(),
      'dateModified' => optional($post->updated_at)->toIso8601String(),
      'author' => [
          '@'.'type' => 'Person',
          'name' => $post->author,
          'url' => url('/'),
      ],
      'publisher' => [
          '@'.'type' => 'Organization',
          'name' => 'Grey Patrick',
          'logo' => [
              '@'.'type' => 'ImageObject',
              'url' => asset('assets/apple-touch-icon.png'),
          ],
      ],
      'mainEntityOfPage' => [
          '@'.'type' => 'WebPage',
          '@'.'id' => route('blog.show', $post->slug),
      ],
  ],
])

@section('content')
  <article>
    <header class="page-hero section-pad blog-hero">
      <p class="eyebrow">{{ optional($post->published_at)->format('d M Y') }} / {{ $post->author }}</p>
      <h1 id="page-title">{{ $post->title }}</h1>
      @if ($post->excerpt)
        <p>{{ $post->excerpt }}</p>
      @endif
    </header>

    <section class="section-pad article-layout">
      @if ($post->image)
        <img class="article-image" src="{{ $post->image }}" alt="{{ $post->imageAlt ?? '' }}">
      @else
        <img class="article-image" src="{{ asset('assets/grey-patrick-workflow-desk.png') }}" alt="">
      @endif

      <div class="article-body">
        {!! str($post->post)->sanitizeHtml() !!}
      </div>
    </section>
  </article>

  <section class="section-pad cta-section">
    <p class="eyebrow">Need Help With This?</p>
    <h2>Turn the idea into a website, workflow or platform.</h2>
    <a class="button button-primary" href="{{ route('quote') }}">Start a Project</a>
  </section>
@endsection
