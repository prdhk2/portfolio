@extends('layouts.app')

@section('content')
    <main role="main" class="errorPage" aria-labelledby="pageTitle">
        <section class="left" aria-hidden="false">
            <div class="eyebrow">Page not found</div>
            <h1 id="pageTitle">Uh oh — we can't find that page</h1>
            <p class="lead">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable. Try returning home or contact me <a href="#">Here</a>.</p>

            <div class="actions" role="navigation" aria-label="404 actions">
                <a class="btn" href="{{ url('/') }}" title="Go to home" style="color:white !important">
                    <!-- home icon (inline, small) -->
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 11.5L12 4l9 7.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Go home
                </a>

                <a class="btn secondary" href="{{ url()->previous() }}" title="Go back">
                    Back
                </a>
            </div>

            <p style="margin-top:18px;color:var(--muted);font-size:13px">Tip: Check the URL for typos or use the search to find what you need.</p>
        </section>

        <aside class="visual" aria-hidden="true">
            <div class="scene" aria-hidden="true">
                <!-- decorative 404 composition -->
                <div class="digits" aria-hidden="true">
                    <div style="position:absolute; left:6%; transform:translateY(-6px)">4</div>
                    <div class="filled" aria-hidden="true">404</div>
                    <div style="position:absolute; right:6%; transform:translateY(-6px)">4</div>
                </div>

                <div class="orb one" aria-hidden="true"></div>
                <div class="orb two" aria-hidden="true"></div>
                <div class="orb three" aria-hidden="true"></div>

                <!-- subtle scene caption -->
                <div class="scene-caption">Lost in our page</div>
            </div>
        </aside>
    </main>
@endsection