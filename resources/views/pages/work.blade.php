@extends('layouts.app', [
  'title' => 'Work | Website Projects for South Coast Businesses',
  'description' => 'Selected website and digital platform projects by Grey Patrick, including Digital Content Engine, Rachel Goodall, BiteSaavy, Chichester 3D Printing and Game Shop Cosham.',
  'canonical' => url('/work'),
  'keywords' => 'Grey Patrick portfolio, West Sussex website portfolio, South Coast website projects, Digital Content Engine, Rachel Goodall, BiteSaavy, Chichester 3D Printing, Game Shop Cosham, local business websites, responsive website design',
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Selected Work</p>
    <h1 id="page-title">Websites and digital systems with practical outcomes.</h1>
    <p>
      A focused look at live projects across AI content systems, coaching,
      food tech, local services and retail, built around clarity, responsive
      design, local search visibility and simple enquiry paths.
    </p>
  </section>

  <section class="section-pad page-image-band">
    <img src="{{ asset('assets/grey-patrick-ai-desk.png') }}" alt="Grey Patrick at a laptop with digital planning icons">
    <div>
      <p class="eyebrow">Selected Projects</p>
      <h2>Each project is built around clarity, trust and the next useful action.</h2>
      <p>
        The work below is deliberately practical: clear pages, responsive layouts,
        easy contact routes and a brand presence that helps visitors understand the offer quickly.
      </p>
    </div>
  </section>

  <section class="section-pad work-grid">
    <article class="showcase-card">
      <div class="work-shot work-shot-dce" aria-hidden="true">
        <div class="shot-browser"><span></span><span></span><span></span></div>
        <div class="shot-hero"></div>
        <div class="shot-rows"><i></i><i></i><i></i></div>
      </div>
      <p class="card-label">AI Content Platform</p>
      <h2>Digital Content Engine</h2>
      <p>A content system and platform presence built around AI-supported publishing workflows, clear positioning and practical automation.</p>
      <ul class="tag-list" aria-label="Digital Content Engine services">
        <li>Platform Design</li>
        <li>AI Workflow</li>
        <li>Content System</li>
        <li>Laravel Build</li>
      </ul>
      <a class="card-link" href="https://digitalcontentengine.com/" target="_blank" rel="noopener noreferrer">Visit Site</a>
    </article>

    <article class="showcase-card">
      <div class="work-shot work-shot-rachel" aria-hidden="true">
        <div class="shot-browser"><span></span><span></span><span></span></div>
        <div class="shot-hero"></div>
        <div class="shot-rows"><i></i><i></i><i></i></div>
      </div>
      <p class="card-label">Personal Brand Website</p>
      <h2>Rachel Goodall</h2>
      <p>A professional personal brand website shaped around trust, clear messaging and an easy route for visitors to understand the offer.</p>
      <ul class="tag-list" aria-label="Rachel Goodall services">
        <li>Website Build</li>
        <li>Personal Brand</li>
        <li>Responsive UI</li>
        <li>Contact Flow</li>
      </ul>
      <a class="card-link" href="https://rachelgoodall.com/" target="_blank" rel="noopener noreferrer">Visit Site</a>
    </article>

    <article class="showcase-card">
      <div class="work-shot work-shot-bitesaavy" aria-hidden="true">
        <div class="shot-browser"><span></span><span></span><span></span></div>
        <div class="shot-hero"></div>
        <div class="shot-rows"><i></i><i></i><i></i></div>
      </div>
      <p class="card-label">Food Tech Website</p>
      <h2>BiteSaavy</h2>
      <p>A clean digital presence for a food-focused platform, designed around clarity, product storytelling and a polished user experience.</p>
      <ul class="tag-list" aria-label="BiteSaavy services">
        <li>Website Build</li>
        <li>Responsive UI</li>
        <li>Brand Direction</li>
        <li>SEO Foundations</li>
      </ul>
      <a class="card-link" href="https://bitesaavy.com/" target="_blank" rel="noopener noreferrer">Visit Site</a>
    </article>

    <article class="showcase-card">
      <div class="work-shot work-shot-printing" aria-hidden="true">
        <div class="shot-browser"><span></span><span></span><span></span></div>
        <div class="shot-hero"></div>
        <div class="shot-rows"><i></i><i></i><i></i></div>
      </div>
      <p class="card-label">Local Service Website</p>
      <h2>Chichester 3D Printing</h2>
      <p>A service-led website for a specialist Chichester 3D printing business, built to explain the offer quickly and make enquiries easy.</p>
      <ul class="tag-list" aria-label="Chichester 3D Printing services">
        <li>Service Pages</li>
        <li>Local SEO</li>
        <li>Lead Capture</li>
        <li>Responsive Build</li>
      </ul>
      <a class="card-link" href="https://chichester3dprinting.com/" target="_blank" rel="noopener noreferrer">Visit Site</a>
    </article>

    <article class="showcase-card">
      <div class="work-shot work-shot-games" aria-hidden="true">
        <div class="shot-browser"><span></span><span></span><span></span></div>
        <div class="shot-hero"></div>
        <div class="shot-rows"><i></i><i></i><i></i></div>
      </div>
      <p class="card-label">Independent Retail Website</p>
      <h2>Game Shop Cosham</h2>
      <p>A bold website for an independent games retailer near Portsmouth, focused on local discovery, simple navigation and a strong shop identity.</p>
      <ul class="tag-list" aria-label="Game Shop Cosham services">
        <li>Retail Web</li>
        <li>Local Presence</li>
        <li>Brand Styling</li>
        <li>Contact Flow</li>
      </ul>
      <a class="card-link" href="https://gameshopcosham.com/" target="_blank" rel="noopener noreferrer">Visit Site</a>
    </article>
  </section>

  <section class="section-pad cta-section">
    <p class="eyebrow">Need Something Like This?</p>
    <h2>Build a website with the systems behind it handled properly.</h2>
    <a class="button button-primary" href="{{ route('quote') }}">Start a Project Quote</a>
  </section>
@endsection
