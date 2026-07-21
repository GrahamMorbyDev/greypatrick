<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Grey Patrick builds websites, Laravel platforms and AI automation systems for ambitious businesses.' }}">
    @isset($keywords)
      <meta name="keywords" content="{{ $keywords }}">
    @endisset
    <meta name="author" content="Grey Patrick">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#11100e">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Grey Patrick | AI Systems Agency' }}">
    <meta property="og:description" content="{{ $description ?? 'Websites plus the AI systems that run behind them.' }}">
    <meta property="og:image" content="{{ asset('assets/grey-patrick-process-wall.png') }}">
    <meta property="og:image:alt" content="Grey Patrick planning AI systems and website workflows">
    <meta property="og:site_name" content="Grey Patrick">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@GreySpectre82">
    <meta name="twitter:creator" content="@GreySpectre82">
    <meta name="twitter:title" content="{{ $title ?? 'Grey Patrick | AI Systems Agency' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Websites plus the AI systems that run behind them.' }}">
    <meta name="twitter:image" content="{{ asset('assets/grey-patrick-process-wall.png') }}">
    <meta name="twitter:image:alt" content="Grey Patrick planning AI systems and website workflows">

    <title>{{ $title ?? 'Grey Patrick | AI Systems Agency' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="preload" href="{{ asset('assets/grey-patrick-process-wall.png') }}" as="image">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
  </head>
  <body>
    <div class="page-shell {{ $shellClass ?? '' }}">
      <div class="ambient-grid" aria-hidden="true"></div>

      <header class="site-header">
        <a class="site-brand" href="{{ route('home') }}" aria-label="Grey Patrick home">
          <span class="brand-monogram" aria-hidden="true">
            <span>G</span>
            <span>P</span>
          </span>
          <span>
            <strong>Grey Patrick</strong>
            <small>AI Systems & Websites</small>
          </span>
        </a>

        <nav class="site-nav" aria-label="Primary navigation">
          <a href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Home</a>
          <a href="{{ route('services') }}" @if(request()->routeIs('services')) aria-current="page" @endif>Services</a>
          <a href="{{ route('work') }}" @if(request()->routeIs('work')) aria-current="page" @endif>Work</a>
          <a href="{{ route('blog.index') }}" @if(request()->routeIs('blog.*')) aria-current="page" @endif>Blog</a>
          <a href="{{ route('contact') }}" @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>
        </nav>

        <a class="header-cta" href="{{ route('quote') }}">Start a Project</a>
      </header>

      <main aria-labelledby="page-title">
        @yield('content')
      </main>

      <footer class="site-footer">
        <div>
          <strong>Grey Patrick</strong>
          <span>Professional websites, Laravel platforms and practical AI automation.</span>
        </div>
        <nav aria-label="Footer links">
          <a href="mailto:grahampatrickdev@gmail.com">Email</a>
          <a href="https://github.com/GrahamMorbyDev" target="_blank" rel="noopener noreferrer">GitHub</a>
          <a href="https://x.com/GreySpectre82" target="_blank" rel="noopener noreferrer">X</a>
          <a href="https://www.linkedin.com/in/graham-patrick-4039352a7/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
        </nav>
        <p>© 2026 Grey Patrick. Based on the South Coast of England.</p>
      </footer>
    </div>
  </body>
</html>
