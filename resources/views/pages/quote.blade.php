@extends('layouts.app', [
  'title' => 'Request a Quote | West Sussex Website & AI Systems Projects',
  'description' => 'Request a project quote from Grey Patrick for business websites, Laravel platforms and AI automation systems in West Sussex and across the South Coast.',
  'canonical' => url('/quote'),
  'keywords' => 'website quote West Sussex, website redesign quote, Laravel development quote, AI automation quote, OpenAI workflow quote, business website quote, South Coast web developer',
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Project Quote</p>
    <h1 id="page-title">Tell me what you need built.</h1>
    <p>
      Share the essentials and I’ll come back with a clear recommendation,
      estimated scope and sensible next steps for your website, platform or automation.
    </p>
  </section>

  <section class="section-pad form-layout">
    <aside class="form-aside">
      <img class="aside-image" src="{{ asset('assets/grey-patrick-portrait.png') }}" alt="Portrait of Grey Patrick">
      <p class="eyebrow">Good Fit For</p>
      <ul>
        <li>New websites and redesigns for West Sussex businesses</li>
        <li>Landing pages and lead capture</li>
        <li>Laravel portals and dashboards</li>
        <li>AI features and OpenAI workflows</li>
      </ul>
      <p>No hard sell. Just a practical reply about whether I can help and what the best route looks like.</p>
      <p>Built on 15+ years of Laravel industry experience, with Python and AI training used to add practical automation where it genuinely helps.</p>
    </aside>

    <form class="agency-form" action="{{ route('quote.submit') }}" method="post">
      @csrf
      @include('partials.form-status')

      <div class="form-grid">
        <label>
          Name
          <input type="text" name="name" autocomplete="name" value="{{ old('name') }}" required>
        </label>
        <label>
          Email
          <input type="email" name="email" autocomplete="email" value="{{ old('email') }}" required>
        </label>
      </div>

      <div class="form-grid">
        <label>
          Business / Project Name
          <input type="text" name="project_name" autocomplete="organization" value="{{ old('project_name') }}">
        </label>
        <label>
          Current Website URL
          <input type="url" name="website" placeholder="https://" value="{{ old('website') }}">
        </label>
      </div>

      <label>
        What do you need?
        <select name="project_type" required>
          <option value="">Select one</option>
          @foreach (['New website', 'Website redesign', 'Landing page', 'Laravel / custom web app', 'AI feature or automation', 'Not sure yet'] as $option)
            <option @selected(old('project_type') === $option)>{{ $option }}</option>
          @endforeach
        </select>
      </label>

      <div class="form-grid">
        <label>
          Budget Range
          <select name="budget">
            <option value="">Select one</option>
            @foreach (['Under £500', '£500 - £1,500', '£1,500 - £3,000', '£3,000+'] as $option)
              <option @selected(old('budget') === $option)>{{ $option }}</option>
            @endforeach
          </select>
        </label>
        <label>
          Ideal Launch Timeframe
          <select name="timeframe">
            <option value="">Select one</option>
            @foreach (['ASAP', '2-4 weeks', '1-3 months', 'Flexible'] as $option)
              <option @selected(old('timeframe') === $option)>{{ $option }}</option>
            @endforeach
          </select>
        </label>
      </div>

      <label>
        Tell me about the project
        <textarea name="message" rows="6" required>{{ old('message') }}</textarea>
      </label>

      <label class="bot-field" aria-hidden="true">
        Company website
        <input type="text" name="company_website" tabindex="-1" autocomplete="off">
      </label>

      @isset($humanChallenge)
        <label>
          Quick anti-spam check: what is {{ $humanChallenge['left'] }} + {{ $humanChallenge['right'] }}?
          <input type="number" name="human_answer" inputmode="numeric" required>
        </label>
      @endisset

      <button type="submit">Request Quote</button>
    </form>
  </section>
@endsection
