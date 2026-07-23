@extends('layouts.app', [
  'title' => 'Contact | Grey Patrick West Sussex Web & AI Systems',
  'description' => 'Contact Grey Patrick for West Sussex website projects, Laravel platforms, OpenAI automation, Codex workflows and software engineering enquiries.',
  'canonical' => url('/contact'),
  'keywords' => 'contact Grey Patrick, West Sussex web developer, AI automation consultant West Sussex, Laravel developer contact, OpenAI workflow consultant, Graham Patrick',
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Contact</p>
    <h1 id="page-title">Let’s build something useful and commercially sharp.</h1>
    <p>
      For West Sussex website projects, Laravel platforms, AI automation, Codex workflows or collaboration enquiries.
    </p>
  </section>

  <section class="section-pad form-layout">
    <aside class="contact-panel">
      <img class="aside-image" src="{{ asset('assets/grey-patrick-portrait.png') }}" alt="Portrait of Grey Patrick">
      <a href="mailto:grahampatrickdev@gmail.com">
        <span>Email</span>
        grahampatrickdev@gmail.com
      </a>
      <a href="https://github.com/GrahamMorbyDev" target="_blank" rel="noopener noreferrer">
        <span>GitHub</span>
        GrahamMorbyDev
      </a>
      <a href="https://x.com/GreyPatrickAI" target="_blank" rel="noopener noreferrer">
        <span>X</span>
        @greypatrickAI
      </a>
      <a href="https://www.linkedin.com/in/graham-patrick-4039352a7/" target="_blank" rel="noopener noreferrer">
        <span>LinkedIn</span>
        Graham Patrick
      </a>
    </aside>

    <form class="agency-form" action="{{ route('contact.submit') }}" method="post">
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

      <label>
        Reason for contact
        <select name="reason" required>
          <option value="">Select one</option>
          @foreach (['Website project', 'AI platform work', 'Laravel / software engineering', 'Collaboration', 'General enquiry'] as $option)
            <option @selected(old('reason') === $option)>{{ $option }}</option>
          @endforeach
        </select>
      </label>

      <label>
        Message
        <textarea name="message" rows="7" required>{{ old('message') }}</textarea>
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

      <button type="submit">Send Message</button>
    </form>
  </section>
@endsection
