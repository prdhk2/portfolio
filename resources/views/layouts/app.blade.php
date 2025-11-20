{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pradhika Setyawan - Web Developer & Engineer</title>
    
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🚀</text></svg>">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='grad' x1='0%' y1='0%' x2='100%' y2='100%'><stop offset='0%' style='stop-color:%237c5cff;stop-opacity:1' /><stop offset='100%' style='stop-color:%234ec2ff;stop-opacity:1' /></linearGradient></defs><circle cx='50' cy='50' r='45' fill='url(%23grad)'/><text x='50' y='65' text-anchor='middle' fill='white' font-family='Arial, sans-serif' font-size='40' font-weight='bold'>P</text></svg>">
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <!-- Page Load Spinner -->
    <div id="pageLoader" class="page-loader">
        <!-- Pilih salah satu spinner style -->
        
        <!-- Style 1: Classic Spinner -->
        <div class="spinner"></div>
        
        <!-- Style 2: Dots Spinner (Uncomment untuk menggunakan) -->
        <!-- <div class="spinner--dots">
            <div class="dot"></div>
            <div class="dot"></div>
            <div class="dot"></div>
        </div> -->
        
        <!-- Style 3: Wave Spinner (Uncomment untuk menggunakan) -->
        <!-- <div class="spinner--wave">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div> -->
        
        <div class="loader-text">Loading portfolio...</div>
    </div>

    @yield('content')
    
    {{-- Scripts section --}}
    @stack('scripts')
    
    {{-- Main app script --}}
    <script src="{{ asset('js/script.js') }}"></script>

    <script>
        // Page Load Spinner Handler
        class PageLoader {
            constructor() {
                this.loader = document.getElementById('pageLoader');
                this.minDisplayTime = 800; // Minimum display time in ms
                this.startTime = Date.now();
                
                this.init();
            }
            
            init() {
                // Hide loader when page is fully loaded
                window.addEventListener('load', () => {
                    this.hide();
                });
                
                // Fallback: hide after max time
                setTimeout(() => {
                    this.hide();
                }, 3000);
            }
            
            hide() {
                const elapsedTime = Date.now() - this.startTime;
                const remainingTime = Math.max(0, this.minDisplayTime - elapsedTime);
                
                setTimeout(() => {
                    this.loader.classList.add('hidden');
                    
                    // Remove from DOM after animation
                    setTimeout(() => {
                        if (this.loader.parentNode) {
                            this.loader.parentNode.removeChild(this.loader);
                        }
                    }, 500);
                }, remainingTime);
            }
            
            // Method to show loader manually (for AJAX etc.)
            show() {
                if (!this.loader.parentNode) {
                    document.body.appendChild(this.loader);
                }
                this.loader.classList.remove('hidden');
                this.startTime = Date.now();
            }
        }
        
        // Initialize page loader
        document.addEventListener('DOMContentLoaded', () => {
            window.pageLoader = new PageLoader();
        });
    </script>
</body>
</html>