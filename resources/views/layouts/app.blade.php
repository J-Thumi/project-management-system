<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Client Portal, GreenScape Projects')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

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
<body class="font-body bg-base text-[#1f2a1f] antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex min-h-screen">

        @include('partials.app-sidebar')

        <div class="flex-1 flex flex-col min-w-0">

            @include('partials.app-topbar')

            <main class="flex-1 px-6 py-8 max-w-7xl w-full mx-auto">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
