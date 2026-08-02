<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $description ?? 'Grey Patrick builds professional websites, Laravel platforms and practical AI automation systems for businesses in West Sussex and across the South Coast.' }}">
    @isset($keywords)
      <meta name="keywords" content="{{ $keywords }}">
    @else
      <meta name="keywords" content="Grey Patrick, Graham Patrick, West Sussex website designer, West Sussex web developer, Laravel developer West Sussex, AI automation consultant, OpenAI developer, business websites, Laravel platforms, South Coast web design">
    @endisset
    <meta name="author" content="Grey Patrick">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#11100e">
    <meta name="geo.region" content="GB-WSX">
    <meta name="geo.placename" content="West Sussex, England">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_GB">
    <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
    <meta property="og:title" content="{{ $title ?? 'Grey Patrick | West Sussex AI Systems & Website Agency' }}">
    <meta property="og:description" content="{{ $description ?? 'Professional websites, Laravel platforms and practical AI automation for West Sussex and South Coast businesses.' }}">
    <meta property="og:image" content="{{ asset('assets/grey-patrick-process-wall.png') }}">
    <meta property="og:image:width" content="770">
    <meta property="og:image:height" content="690">
    <meta property="og:image:alt" content="Grey Patrick planning AI systems and website workflows">
    <meta property="og:site_name" content="Grey Patrick">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@greypatrickAI">
    <meta name="twitter:creator" content="@greypatrickAI">
    <meta name="twitter:title" content="{{ $title ?? 'Grey Patrick | West Sussex AI Systems & Website Agency' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Professional websites, Laravel platforms and practical AI automation for West Sussex and South Coast businesses.' }}">
    <meta name="twitter:image" content="{{ asset('assets/grey-patrick-process-wall.png') }}">
    <meta name="twitter:image:alt" content="Grey Patrick planning AI systems and website workflows">

    <title>{{ $title ?? 'Grey Patrick | West Sussex AI Systems & Website Agency' }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/apple-touch-icon.png') }}">
    <link rel="preload" href="{{ asset('assets/grey-patrick-process-wall.png') }}" as="image">
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <script type="application/ld+json">
      {!! json_encode($structuredData ?? [
          '@context' => 'https://schema.org',
          '@type' => 'ProfessionalService',
          '@id' => url('/').'#business',
          'name' => 'Grey Patrick',
          'alternateName' => 'Graham Patrick',
          'url' => url('/'),
          'image' => asset('assets/grey-patrick-process-wall.png'),
          'description' => 'Professional websites, Laravel platforms and practical AI automation systems for businesses in West Sussex and across the South Coast.',
          'email' => 'grahampatrickdev@gmail.com',
          'areaServed' => [
              ['@type' => 'AdministrativeArea', 'name' => 'West Sussex'],
              ['@type' => 'City', 'name' => 'Chichester'],
              ['@type' => 'City', 'name' => 'Worthing'],
              ['@type' => 'City', 'name' => 'Bognor Regis'],
              ['@type' => 'City', 'name' => 'Portsmouth'],
              ['@type' => 'AdministrativeArea', 'name' => 'South Coast England'],
          ],
          'founder' => [
              '@type' => 'Person',
              'name' => 'Grey Patrick',
              'sameAs' => [
                  'https://github.com/GrahamMorbyDev',
                  'https://x.com/GreyPatrickAI',
                  'https://www.linkedin.com/in/graham-patrick-4039352a7/',
              ],
          ],
          'knowsAbout' => [
              'Website design',
              'Laravel development',
              'AI automation',
              'OpenAI workflows',
              'Codex workflows',
              'Business systems',
              'Local SEO',
          ],
          'sameAs' => [
              'https://github.com/GrahamMorbyDev',
              'https://x.com/GreyPatrickAI',
              'https://www.linkedin.com/in/graham-patrick-4039352a7/',
          ],
      ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
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
          <span>Professional websites, Laravel platforms and practical AI automation for West Sussex and South Coast businesses.</span>
        </div>
        <nav aria-label="Footer links">
          <a href="mailto:grahampatrickdev@gmail.com">Email</a>
          <a href="{{ route('links') }}">Links</a>
          <a href="https://github.com/GrahamMorbyDev" target="_blank" rel="noopener noreferrer">GitHub</a>
          <a href="https://x.com/GreyPatrickAI" target="_blank" rel="noopener noreferrer">X</a>
          <a href="https://www.linkedin.com/in/graham-patrick-4039352a7/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
        </nav>
        <p>© 2026 Grey Patrick. Based in West Sussex on the South Coast of England.</p>
      </footer>
    </div>
  </body>
</html>
