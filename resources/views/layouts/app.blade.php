<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', savedTheme);
            
            // Apply saved colors
            const savedColors = JSON.parse(localStorage.getItem('customColors') || '{}');
            for (const [key, val] of Object.entries(savedColors)) {
                document.documentElement.style.setProperty('--' + key, val);
            }

            // Apply transition speed
            const savedSpeed = localStorage.getItem('transitionSpeed');
            if (savedSpeed) {
                document.documentElement.style.setProperty('--transition', savedSpeed + ' cubic-bezier(0.4,0,0.2,1)');
            }

            // Apply card hover lift
            const savedConfig = JSON.parse(localStorage.getItem('systemConfig') || '{}');
            if (savedConfig.cardHover === false) {
                document.addEventListener('DOMContentLoaded', () => {
                    document.body.classList.add('no-hover-lift');
                });
            }
        })();
    </script>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title ?? 'Kazipoa — Service Marketplace System' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,300;0,6..12,400;0,6..12,500;0,6..12,600;0,6..12,700;0,6..12,800;0,6..12,900;1,6..12,400&display=swap" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    @include('partials.styles')
    @stack('styles')
</head>
<body>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Modal -->
@include('partials.modal')

<!-- App Layout -->
<div class="app-layout">
    @include('partials.sidebar')

    <!-- MAIN CONTENT -->
    <div class="main-content">
        @include('partials.header')

        <!-- PAGE CONTENT -->
        <div class="page-content">
            @yield('content')
        </div>

        @include('partials.footer')
    </div>
</div>

@include('partials.scripts')
@stack('scripts')
</body>
</html>
