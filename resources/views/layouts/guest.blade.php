<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GreenScape Projects')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind (utility layout) + shared theme (brand colors / components) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { DEFAULT: '#2f5233', dark: '#203a24', light: '#4a7856' },
                        secondary: { DEFAULT: '#8bc34a', dark: '#6a9c34' },
                        accent: { DEFAULT: '#c9a66b', light: '#e6d3ad' },
                        surface: '#ffffff',
                        base: '#f8f6f1',
                    },
                    fontFamily: {
                        heading: ['Poppins', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    @stack('styles')
</head>
<body class="font-body bg-base text-[#1f2a1f] antialiased">

    @include('partials.guest-nav')

    <main>
        @yield('content')
    </main>

    <footer class="bg-primary-dark text-base/90 mt-20">
        <div class="max-w-6xl mx-auto px-6 py-12 grid gap-8 md:grid-cols-3">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-primary-dark font-bold">G</span>
                    <span class="font-heading font-semibold text-white text-lg">GreenScape Projects</span>
                </div>
                <p class="text-sm text-white/70 max-w-xs">
                    From first inquiry to final planting, one platform to design, quote,
                    track, and deliver every landscaping project.
                </p>
            </div>
            <div>
                <h4 class="text-white font-heading font-semibold mb-3 text-sm uppercase tracking-wide">Company</h4>
                <ul class="space-y-2 text-sm text-white/70">
                    <li><a href="#" class="hover:text-secondary">About us</a></li>
                    <li><a href="#" class="hover:text-secondary">Our projects</a></li>
                    <li><a href="#" class="hover:text-secondary">Careers</a></li>
                    <li><a href="#" class="hover:text-secondary">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-heading font-semibold mb-3 text-sm uppercase tracking-wide">Get started</h4>
                <ul class="space-y-2 text-sm text-white/70">
                    <li><a href="{{ route('register') }}" class="hover:text-secondary">Create an account</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-secondary">Client login</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-white/50">
            &copy; {{ date('Y') }} GreenScape Projects. All rights reserved.
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
