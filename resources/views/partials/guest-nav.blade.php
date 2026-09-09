<header x-data="{ open: false }" class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-[#e3dfd3]">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">G</span>
            <span class="font-heading font-semibold text-primary-dark text-lg">GreenScape Projects</span>
        </a>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-[#5c6b5c]">
            <a href="{{ route('landing') }}#services" class="hover:text-primary">Services</a>
            <a href="{{ route('landing') }}#process" class="hover:text-primary">How it works</a>
            <a href="{{ route('landing') }}#about" class="hover:text-primary">About</a>
            <a href="{{ route('landing') }}#contact" class="hover:text-primary">Contact</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-outline !py-2 !px-4 text-sm">Log in</a>
            <a href="{{ route('register') }}" class="btn btn-primary !py-2 !px-4 text-sm">Get started</a>
        </div>

        <button @click="open = !open" class="md:hidden text-primary-dark">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </nav>

    <div x-show="open" x-cloak class="md:hidden border-t border-[#e3dfd3] bg-white px-6 py-4 space-y-3">
        <a href="{{ route('landing') }}#services" class="block text-sm text-[#5c6b5c]">Services</a>
        <a href="{{ route('landing') }}#process" class="block text-sm text-[#5c6b5c]">How it works</a>
        <a href="{{ route('landing') }}#about" class="block text-sm text-[#5c6b5c]">About</a>
        <a href="{{ route('landing') }}#contact" class="block text-sm text-[#5c6b5c]">Contact</a>
        <div class="flex gap-3 pt-2">
            <a href="{{ route('login') }}" class="btn btn-outline !py-2 !px-4 text-sm w-full">Log in</a>
            <a href="{{ route('register') }}" class="btn btn-primary !py-2 !px-4 text-sm w-full">Get started</a>
        </div>
    </div>
</header>
