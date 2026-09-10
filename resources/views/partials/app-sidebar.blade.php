{{-- Desktop sidebar --}}
<aside class="hidden md:flex md:flex-col w-64 shrink-0 bg-primary-dark text-white/90 min-h-screen">
    <div class="h-16 flex items-center gap-2 px-6 border-b border-white/10">
        <span class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-primary-dark font-bold text-sm">G</span>
        <span class="font-heading font-semibold text-white">GreenScape</span>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
        @php
            $links = [
                ['label' => 'Dashboard', 'route' => 'dashboard'],
                ['label' => 'My Projects', 'route' => 'projects.index'],
                ['label' => 'Quotations', 'route' => 'quotations.index'],
                ['label' => 'Messages', 'route' => 'messages.index'],
                ['label' => 'Profile', 'route' => 'profile'],
            ];
        @endphp

        @foreach ($links as $link)
            <a href="{{ route($link['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors
                      {{ request()->routeIs($link['route']) ? 'bg-secondary/20 text-white font-semibold' : 'hover:bg-white/10' }}">
                {{ $link['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="p-4 border-t border-white/10">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm w-full hover:bg-white/10">
                Log out
            </button>
        </form>
    </div>
</aside>

{{-- Mobile slide-over sidebar --}}
<div x-show="sidebarOpen" x-cloak class="md:hidden fixed inset-0 z-50">
    <div class="absolute inset-0 bg-black/40" @click="sidebarOpen = false"></div>
    <aside class="absolute inset-y-0 left-0 w-64 bg-primary-dark text-white/90 flex flex-col">
        <div class="h-16 flex items-center justify-between px-6 border-b border-white/10">
            <span class="font-heading font-semibold text-white">GreenScape</span>
            <button @click="sidebarOpen = false" class="text-white/70">✕</button>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10">Dashboard</a>
            <a href="{{ route('projects.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10">My Projects</a>
            <a href="{{ route('quotations.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10">Quotations</a>
            <a href="{{ route('messages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10">Messages</a>
            <a href="{{ route('profile') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-white/10">Profile</a>
        </nav>
        <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm w-full hover:bg-white/10">Log out</button>
            </form>
        </div>
    </aside>
</div>
