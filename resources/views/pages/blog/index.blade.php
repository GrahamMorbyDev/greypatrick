@extends('layouts.app', [
  'title' => 'Blog | AI, Websites, Laravel & Business Systems',
  'description' => 'Articles from Grey Patrick on website strategy, AI automation, Laravel platforms, Codex workflows and practical digital systems for businesses.',
  'canonical' => route('blog.index'),
  'keywords' => 'Grey Patrick blog, AI automation blog, Laravel development articles, website strategy West Sussex, Codex workflows, OpenAI workflows, business systems blog',
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Blog</p>
    <h1 id="page-title">Notes on websites, AI systems and practical builds.</h1>
    <p>
      Articles, build notes and useful thinking for businesses exploring better
      websites, Laravel platforms and AI-supported workflows.
    </p>
  </section>

  <section class="section-pad blog-grid">
    @forelse ($posts as $post)
      <article class="blog-card">
        <a href="{{ route('blog.show', $post) }}" aria-label="Read {{ $post->title }}">
          @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="">
          @else
            <img src="{{ asset('assets/grey-patrick-workflow-desk.png') }}" alt="">
          @endif
          <div>
            <p class="card-label">{{ optional($post->published_at)->format('d M Y') }} / {{ $post->author }}</p>
            <h2>{{ $post->title }}</h2>
            @if ($post->excerpt)
              <p>{{ $post->excerpt }}</p>
            @endif
            <span>Read article</span>
          </div>
        </a>
      </article>
    @empty
      <div class="empty-state">
        <p class="eyebrow">Coming Soon</p>
        <h2>Blog posts will appear here once they are published.</h2>
      </div>
    @endforelse
  </section>

  @if ($posts->hasPages())
    <div class="section-pad pagination-wrap">
      {{ $posts->links() }}
    </div>
  @endif
@endsection
