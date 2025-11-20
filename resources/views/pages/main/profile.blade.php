{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('content')
<main class="page" aria-labelledby="profileTitle">
    <header class="hero">
        <div class="hero-left">
            <h1 id="profileTitle">Pradhika Setyawan</h1>
            <p class="role" style="color: #7c5cff">Engineer · Web Developer</p>
            <p class="tagline">Building reliable systems and beautiful web experiences — JavaScript, PHP, Laravel, and modern UX.</p>

            <div class="badges" aria-hidden="false">
                <span class="badge">Engineer</span>
                <span class="badge">Web Developer</span>
                <span class="badge">UI/UX</span>
            </div>

            <div class="actions">
                {{-- Ganti jadi button dengan ID --}}
                <button class="btn primary" id="contactBtn">Contact</button>
                <a class="btn ghost" href="{{ url('/resume') }}">Resume</a>
            </div>
        </div>

        <div class="hero-right" aria-hidden="true">
            <div class="photo-stack" role="img" aria-label="Floating photos">
                <img src="{{ asset('images/photo2.png') }}" alt="Portrait 1" class="photo p1">
            </div>
        </div>
    </header>

    <section class="overview">
        <h2>What I do</h2>
        <p>Design and implement scalable web apps, APIs, and tooling. I enjoy working across the stack and improving developer workflows.</p>

        <div class="skills-grid" aria-hidden="false" id="skillsGrid">
            <button class="skill" data-tech="laravel" type="button">Laravel</button>
            <button class="skill" data-tech="nodejs" type="button">Node Js</button>
            <button class="skill" data-tech="codeigneter" type="button">Codeigneter</button>
            <button class="skill" data-tech="iot" type="button">IoT</button>
        </div>

        <!-- Projects panel -->
        <section id="projectsSection" class="projects-section" hidden aria-live="polite" aria-labelledby="projectsTitle">
            <div class="projects-header">
                <h3 id="projectsTitle">Projects</h3>
                <button id="closeProjects" type="button" class="projects-close" aria-label="Close projects">&times;</button>
            </div>

            <div id="projectsGrid" class="projects-grid" role="list"></div>
            <p id="projectsEmpty" class="muted" hidden>No projects found for <span id="projectsFor"></span>.</p>
        </section>
    </section>
</main>

{{-- Include Contact Modal Component --}}
<x-contact-modal 
    facebookUrl="https://facebook.com/prdhk.sty"
    instagramUrl="https://instagram.com/prdhk_" 
    whatsappNumber="6285888203401"
    emailAddress="pradhika2112@gmail.com"
/>

@endsection

@push('scripts')
<script type="module" src="{{ asset('js/contact-modal.js') }}"></script>
@endpush