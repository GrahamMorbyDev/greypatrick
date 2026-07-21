@extends('layouts.app', [
  'title' => $post->title.' | Grey Patrick',
  'description' => $post->excerpt ?? 'An article by Grey Patrick.',
  'canonical' => route('blog.show', $post),
  'shellClass' => 'content-shell',
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
        <img class="article-image" src="{{ asset('storage/'.$post->image) }}" alt="">
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
