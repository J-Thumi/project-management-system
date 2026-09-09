<header class="h-16 bg-white border-b border-[#e3dfd3] flex items-center justify-between px-6 sticky top-0 z-30">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = true" class="md:hidden text-primary-dark">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <h1 class="font-heading font-semibold text-lg text-primary-dark">@yield('page-title', 'Dashboard')</h1>
    </div>

    <div class="flex items-center gap-4">
        <button class="relative text-[#5c6b5c] hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.2V11a6 6 0 10-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5m6 0a3 3 0 11-6 0m6 0H9" />
            </svg>
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-secondary rounded-full text-[10px] flex items-center justify-center text-primary-dark font-bold">3</span>
        </button>

        <a href="{{ route('profile') }}" class="flex items-center gap-2">
            <span class="w-9 h-9 rounded-full bg-accent-light flex items-center justify-center font-heading font-semibold text-primary-dark text-sm">
                {{ substr(auth()->user()->name ?? 'J D', 0, 1) }}
            </span>
            <span class="hidden sm:block text-sm font-medium text-[#1f2a1f]">
                {{ auth()->user()->name ?? 'Jane Doe' }}
            </span>
        </a>
    </div>
</header>
