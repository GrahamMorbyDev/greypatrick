@extends('layouts.app', [
  'title' => 'Grey Patrick | West Sussex Website Design, Laravel & AI Systems',
  'canonical' => url('/'),
  'description' => 'Grey Patrick builds professional websites, Laravel platforms and practical AI automation systems for West Sussex businesses and South Coast organisations.',
  'keywords' => 'West Sussex website design, website designer West Sussex, Laravel developer West Sussex, AI automation West Sussex, OpenAI consultant UK, Grey Patrick, Graham Patrick, AI systems agency, business websites South Coast, Chichester web design, Worthing web design',
])

@section('content')
  <section class="home-hero section-pad">
    <div class="hero-copy">
      <p class="eyebrow">West Sussex AI Systems & Website Consultant</p>
      <h1 id="page-title">Professional websites and practical AI systems for growing businesses.</h1>
      <p class="hero-lede">
        I help West Sussex and South Coast businesses improve how they present
        themselves online, capture better enquiries and use AI workflows to save
        time behind the scenes.
      </p>

      <div class="hero-actions">
        <a class="button button-primary" href="{{ route('quote') }}">Start a Project</a>
        <a class="button button-secondary" href="{{ route('work') }}">View Work</a>
      </div>

      <dl class="signal-row" aria-label="Business signals">
        <div>
          <dt>Focus</dt>
          <dd>Business websites and automation</dd>
        </div>
        <div>
          <dt>Experience</dt>
          <dd>15+ years industry experience with Laravel</dd>
        </div>
        <div>
          <dt>AI Layer</dt>
          <dd>Python Development and OpenAI Academy AI Foundations</dd>
        </div>
        <div>
          <dt>Status</dt>
          <dd>Open to West Sussex business projects</dd>
        </div>
      </dl>
    </div>

    <div class="hero-visual" aria-label="Grey Patrick agency visual">
      <div class="portrait-card portrait-card-large">
        <img src="{{ asset('assets/grey-patrick-process-wall.png') }}" alt="Grey Patrick planning a digital workflow at a desk">
      </div>
      <div class="profile-card">
        <img src="{{ asset('assets/grey-patrick-portrait.png') }}" alt="Portrait of Grey Patrick">
        <div>
          <strong>Grey Patrick</strong>
          <span>Founder-led builds with clear communication.</span>
        </div>
      </div>
    </div>
  </section>

  <section class="section-pad split-section">
    <div>
      <p class="eyebrow">What I Build</p>
      <h2>A joined-up approach to your website, workflow and software needs.</h2>
    </div>

    <div class="service-list">
      <article>
        <span>01</span>
        <h3>Professional Websites</h3>
        <p>Fast, responsive websites with clear messaging, strong calls to action, local SEO foundations and contact flows that make enquiries easier.</p>
      </article>
      <article>
        <span>02</span>
        <h3>Practical AI Workflows</h3>
        <p>OpenAI assistants, content workflows, internal automations and Codex-supported delivery systems for repetitive business tasks.</p>
      </article>
      <article>
        <span>03</span>
        <h3>Laravel Platforms</h3>
        <p>Custom portals, dashboards and web apps for businesses that have outgrown basic pages and need software tailored to how they work.</p>
      </article>
    </div>
  </section>

  <section class="section-pad proof-band">
    <div class="section-intro">
      <p class="eyebrow">Selected Work</p>
      <h2>Live projects with practical outcomes.</h2>
      <p>
        Recent website builds focused on clear positioning, responsive layouts
        and making it easier for local visitors and business customers to take the next step.
      </p>
      <a class="text-link" href="{{ route('work') }}">View all work</a>
    </div>

    <div class="proof-grid">
      <a href="https://bitesaavy.com/" target="_blank" rel="noopener noreferrer">
        <span>Food Tech</span>
        <strong>BiteSaavy</strong>
        <p>Product storytelling and a cleaner digital presence for a food-focused platform.</p>
        <em>Visit site</em>
      </a>
      <a href="https://chichester3dprinting.com/" target="_blank" rel="noopener noreferrer">
        <span>Local Service</span>
        <strong>Chichester 3D Printing</strong>
        <p>Service-led structure built to explain the offer and encourage enquiries.</p>
        <em>Visit site</em>
      </a>
      <a href="https://gameshopcosham.com/" target="_blank" rel="noopener noreferrer">
        <span>Retail</span>
        <strong>Game Shop Cosham</strong>
        <p>A straightforward retail presence with local discovery and contact in mind.</p>
        <em>Visit site</em>
      </a>
    </div>
  </section>

  <section class="section-pad image-story">
    <img src="{{ asset('assets/grey-patrick-ai-desk.png') }}" alt="Grey Patrick working on AI planning tools at a laptop">
    <div>
      <p class="eyebrow">Professional, Not Generic</p>
      <h2>Clear thinking, calm delivery and systems that make sense.</h2>
      <p>
        The goal is not to add technology for the sake of it. It is to understand
        the business, design the right digital experience and build tools that help
        the organisation move faster.
      </p>
      <p>
        My core delivery experience is grounded in 15+ years of industry work
        with Laravel and web platforms, supported by continued professional
        development in Python, Flask and OpenAI Academy AI Foundations.
      </p>
    </div>
  </section>

  <section class="section-pad process-section">
    <div>
      <p class="eyebrow">How Projects Run</p>
      <h2>A clear build process from idea to launch.</h2>
    </div>

    <ol class="process-list">
      <li>
        <span>01</span>
        <h3>Map the outcome</h3>
        <p>Clarify the audience, offer, must-have pages, conversion route and useful AI opportunities.</p>
      </li>
      <li>
        <span>02</span>
        <h3>Design the system</h3>
        <p>Create the visual direction, content structure, data flow and technical plan before the build gets heavy.</p>
      </li>
      <li>
        <span>03</span>
        <h3>Build and launch</h3>
        <p>Ship the site or app, test it properly, connect the forms and hand over a maintainable foundation.</p>
      </li>
    </ol>
  </section>

  <section class="section-pad cta-section">
    <p class="eyebrow">Open to Work</p>
    <h2>Need a better website, a smarter workflow or a custom Laravel platform?</h2>
    <a class="button button-primary" href="{{ route('quote') }}">Request a Project Quote</a>
  </section>
@endsection
