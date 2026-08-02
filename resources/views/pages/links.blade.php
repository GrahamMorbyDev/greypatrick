@extends('layouts.app', [
    'title' => 'Grey Patrick Links | AI Systems, Tools & Projects',
    'canonical' => url('/links'),
    'description' => 'Quick links for Grey Patrick: work with Graham, Digital Content Engine, Mesh Medic, Chichester 3D Printing and BiteSaavy.',
    'keywords' => 'Grey Patrick links, Grey Patrick AI, Digital Content Engine, Mesh Medic, Chichester 3D Printing, BiteSaavy',
    'shellClass' => 'links-shell',
])

@section('content')
  <section class="links-hero section-pad">
    <div class="links-profile">
      <img src="{{ asset('assets/grey-patrick-portrait.png') }}" alt="Portrait of Grey Patrick">
      <p class="eyebrow">Grey Patrick AI</p>
      <h1 id="page-title">Useful links for the things I build.</h1>
      <p>AI systems, websites, software and practical tools built by one accountable engineer.</p>
    </div>

    <div class="links-list" aria-label="Grey Patrick links">
      <a class="link-card link-card-primary" href="{{ route('quote') }}">
        <span>Work with Graham</span>
        <strong>AI systems, websites and software</strong>
        <p>Enterprise-level thinking with direct access to the person building the work.</p>
        <em>Start a project</em>
      </a>

      <a class="link-card" href="https://digitalcontentengine.com/" target="_blank" rel="noopener noreferrer">
        <span>Digital Content Engine</span>
        <strong>Weekly content packages for small businesses</strong>
        <p>Blogs, social posts, image suites and CLEAR review from £9.99 per month.</p>
        <em>Visit DCE</em>
      </a>

      <a class="link-card" href="https://mesh-medic.com/" target="_blank" rel="noopener noreferrer">
        <span>Mesh Medic</span>
        <strong>Private mesh repair in your browser</strong>
        <p>Inspect STL, OBJ and 3MF faults, choose repairs and compare before downloading.</p>
        <em>Repair a model</em>
      </a>

      <a class="link-card" href="https://chichester3dprinting.com/" target="_blank" rel="noopener noreferrer">
        <span>Chichester 3D Printing</span>
        <strong>Local 3D printing and practical print support</strong>
        <p>Parts, prototypes, repairs and useful printed things for people and businesses.</p>
        <em>Get printing help</em>
      </a>

      <a class="link-card" href="https://bitesaavy.com/" target="_blank" rel="noopener noreferrer">
        <span>BiteSaavy</span>
        <strong>Food tools, recipes and smarter planning</strong>
        <p>Recipe ideas and practical helpers for making better food choices with less faff.</p>
        <em>Explore BiteSaavy</em>
      </a>
    </div>
  </section>
@endsection
