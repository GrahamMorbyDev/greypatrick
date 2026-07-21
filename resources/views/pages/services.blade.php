@extends('layouts.app', [
  'title' => 'Services | West Sussex Websites, Laravel Platforms & AI Automation',
  'description' => 'Website design, Laravel platform builds and OpenAI automation services for West Sussex and South Coast businesses by Grey Patrick.',
  'canonical' => url('/services'),
  'keywords' => 'West Sussex website services, website design West Sussex, Laravel platform development, AI automation services, OpenAI automation consultant, business workflow automation, Chichester website designer, South Coast web developer',
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Services</p>
      <h1 id="page-title">Websites, platforms and AI workflows built with a practical plan.</h1>
    <p>
      A focused set of services for West Sussex and South Coast businesses that
      need visible polish, practical engineering and smarter workflows in one joined-up build.
    </p>
    <p>
      Grounded in 15+ years of industry experience with Laravel and web
      platforms, supported by hands-on Python and Flask training plus ongoing AI
      learning including OpenAI Academy AI Foundations.
    </p>
  </section>

  <section class="section-pad page-image-band">
    <img src="{{ asset('assets/grey-patrick-workflow-desk.png') }}" alt="Grey Patrick working at a laptop with digital workflow diagrams">
    <div>
      <p class="eyebrow">How I Think</p>
      <h2>Start with the business outcome, then choose the right technology.</h2>
      <p>
        A good build should feel simple to use, easy to explain and useful long
        after launch. That means clear scope, calm delivery and systems that can be maintained.
      </p>
      <p>
        I keep the focus on practical business value: better communication,
        smoother workflows and technology that your business can actually use.
      </p>
    </div>
  </section>

  <section class="section-pad service-detail-grid">
    <article>
      <p class="eyebrow">01 / Websites</p>
      <h2>Modern websites that make the offer clear.</h2>
      <p>Ideal for local and founder-led businesses that need a sharper public presence, stronger messaging and a site that turns interest into enquiries.</p>
      <ul>
        <li>Homepage and landing page design</li>
        <li>Responsive build and performance basics</li>
        <li>Quote/contact forms and conversion paths</li>
        <li>Local SEO foundations and launch checks</li>
      </ul>
    </article>

    <article>
      <p class="eyebrow">02 / AI Automation</p>
      <h2>OpenAI workflows for repeated business tasks.</h2>
      <p>Useful when your business is spending time on content, admin, support, research or internal processes that should be systemised.</p>
      <ul>
        <li>AI assistants and internal tools</li>
        <li>Content and research workflows</li>
        <li>Codex-supported delivery systems</li>
        <li>Automation planning and prototyping</li>
      </ul>
    </article>

    <article>
      <p class="eyebrow">03 / Platforms</p>
      <h2>Custom software when off-the-shelf is limiting.</h2>
      <p>For dashboards, portals and business systems that need a proper backend, clean data flow and room to grow, built on 15+ years of Laravel industry experience.</p>
      <ul>
        <li>Laravel web applications</li>
        <li>Dashboards and admin panels</li>
        <li>Customer or internal portals</li>
        <li>API integrations and data workflows</li>
      </ul>
    </article>
  </section>

  <section class="section-pad cta-section">
    <p class="eyebrow">Project Fit</p>
    <h2>Not sure which service you need? Start with the outcome.</h2>
    <a class="button button-primary" href="{{ route('quote') }}">Tell Me What You Need</a>
  </section>
@endsection
