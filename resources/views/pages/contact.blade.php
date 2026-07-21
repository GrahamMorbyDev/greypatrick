@extends('layouts.app', [
  'title' => 'Contact | Grey Patrick AI Systems Agency',
  'description' => 'Contact Grey Patrick for websites, Laravel platforms, OpenAI automation and software engineering enquiries.',
  'canonical' => url('/contact'),
  'shellClass' => 'content-shell',
])

@section('content')
  <section class="page-hero section-pad">
    <p class="eyebrow">Contact</p>
    <h1 id="page-title">Let’s build something useful and commercially sharp.</h1>
    <p>
      For websites, Laravel platforms, AI automation, Codex workflows or collaboration enquiries.
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
      <a href="https://x.com/GreySpectre82" target="_blank" rel="noopener noreferrer">
        <span>X</span>
        @GreySpectre82
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

      <button type="submit">Send Message</button>
    </form>
  </section>
@endsection
