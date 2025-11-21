{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pradhika Setyawan - Web Developer & IoT Engineer</title>
    
    {{-- <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}"> --}}
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🚀</text></svg>">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='grad' x1='0%' y1='0%' x2='100%' y2='100%'><stop offset='0%' style='stop-color:%237c5cff;stop-opacity:1' /><stop offset='100%' style='stop-color:%234ec2ff;stop-opacity:1' /></linearGradient></defs><circle cx='50' cy='50' r='45' fill='url(%23grad)'/><text x='50' y='65' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='40' font-weight='bold'>P</text></svg>">
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    
    <div id="pageLoader" class="page-loader">
        <div class="spinner"></div>
        
        <div class="loader-text">Loading portfolio...</div>
    </div>

    @yield('content')
    
    {{-- Scripts section --}}
    @stack('scripts')
    
    {{-- Main app script --}}
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/spinner.js') }}"></script>
</body>
</html>