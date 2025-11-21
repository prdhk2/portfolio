@extends('layouts.app')

@section('content')
<main class="page" aria-labelledby="profileTitle">
    <header class="hero">
        <div class="hero-left">
            <h1 id="profileTitle">{{ App\Models\ProfileSetting::getValue('hero_title', 'Pradhika Setyawan') }}</h1>
            <p class="role">{{ App\Models\ProfileSetting::getValue('hero_role', 'Engineer · Web Developer') }}</p>
            <p class="tagline">{{ App\Models\ProfileSetting::getValue('hero_tagline', 'Building reliable systems and beautiful web experiences') }}</p>

            <div class="badges" aria-hidden="false">
                @php
                    $badges = json_decode(App\Models\ProfileSetting::getValue('badges', '[]'), true) ?: ['Engineer', 'Web Developer', 'UI/UX'];
                @endphp
                @foreach($badges as $badge)
                    <span class="badge">{{ $badge }}</span>
                @endforeach
            </div>

            <div class="actions">
                <button class="btn primary" id="contactBtn" type="button">Contact</button>
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
        <h2>{{ App\Models\ProfileSetting::getValue('overview_title', 'What I do') }}</h2>
        <p>{{ App\Models\ProfileSetting::getValue('overview_description', 'Design and implement scalable web apps, APIs, and tooling.') }}</p>

        <div class="skills-grid" aria-hidden="false" id="skillsGrid">
            @foreach(App\Models\Skill::active()->forGrid()->sorted()->get() as $skill)
                <button class="skill" data-tech="{{ $skill->data_tech }}" type="button">{{ $skill->name }}</button>
            @endforeach
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
    facebookUrl="https://facebook.com/yourprofile"
    instagramUrl="https://instagram.com/yourprofile" 
    whatsappNumber="6281234567890"
    emailAddress="your.email@example.com"
/>

@endsection

@push('scripts')
<script type="module" src="{{ asset('js/contact-modal.js') }}"></script>
<script>
    // console.log('=== DEBUG PROJECT DATA ===');
    
    // Sample data dari database
    const projectSamples = {
        @foreach(['laravel', 'nodejs', 'codeigneter', 'iot'] as $tech)
        '{{ $tech }}': [
            @foreach(App\Models\Project::active()->byTechnology($tech)->sorted()->get() as $project)
            {
                title: '{{ addslashes($project->title) }}',
                description: '{{ addslashes($project->description) }}',
                url: '{{ $project->project_url }}',
                code: '{{ $project->code_url }}',
                meta: '{{ $project->meta }}'
            },
            @endforeach
        ],
        @endforeach
    };

    // console.log('ProjectSamples from DB:', projectSamples);
    // console.log('Laravel projects count:', projectSamples.laravel ? projectSamples.laravel.length : 0);
</script>

<script type="module" src="{{ asset('js/script.js') }}"></script>
@endpush