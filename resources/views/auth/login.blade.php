@extends('layouts.guest')

@section('title', 'Log in — GreenScape Projects')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center px-6 py-12 lg:py-16 bg-gradient-to-b from-[#eef3e6]/60 via-[#f5f8f2]/40 to-white relative overflow-hidden">
    {{-- Decorative Background Glow --}}
    <div class="absolute -top-20 -left-20 w-80 h-80 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-accent-light/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        {{-- Header Section --}}
        <div class="text-center mb-8">
            <span class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-dark to-primary flex items-center justify-center text-white font-heading font-bold text-xl mx-auto mb-4 shadow-md shadow-primary-dark/15 border border-white/20">
                G
            </span>
            <h1 class="font-heading text-2xl sm:text-3xl font-bold text-primary-dark tracking-tight">Welcome back</h1>
            <p class="text-[#5c6b5c] text-sm mt-1.5">Log in to track your landscape project in real-time.</p>
        </div>

        {{-- Login Card Container --}}
        <div class="card p-7 sm:p-8 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-primary-dark/5 border border-[#e3dfd3]/80">

            {{-- Status Alert --}}
            @if (session('status'))
                <div class="mb-6 text-xs sm:text-sm rounded-xl bg-emerald-50 text-emerald-900 border border-emerald-200/80 px-4 py-3 font-medium flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf

                {{-- Email Address Field --}}
                <div>
                    <label for="email" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="you@example.com" required autofocus>
                    @error('email')
                        <p class="text-xs text-rose-600 font-medium mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password Field --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="field-label font-medium text-xs sm:text-sm text-primary-dark block">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-accent hover:text-primary-dark font-medium transition-colors">Forgot password?</a>
                    </div>
                    <input id="password" type="password" name="password"
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="••••••••" required>
                    @error('password')
                        <p class="text-xs text-rose-600 font-medium mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me Checkbox --}}
                <div class="flex items-center">
                    <label class="flex items-center gap-2.5 text-xs sm:text-sm text-[#5c6b5c] cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-[#e3dfd3] text-primary focus:ring-2 focus:ring-accent/20 accent-emerald-700 transition">
                        <span>Keep me signed in</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary w-full py-3 rounded-xl font-medium shadow-md shadow-primary-dark/10 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                    Log in
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-6">
                <span class="h-px bg-[#e3dfd3]/80 flex-1"></span>
                <span class="text-xs text-[#5c6b5c] uppercase font-semibold tracking-wider">or</span>
                <span class="h-px bg-[#e3dfd3]/80 flex-1"></span>
            </div>

            {{-- Social Login Button --}}
            <button type="button" class="btn btn-outline w-full py-2.5 rounded-xl border-[#e3dfd3] hover:bg-slate-50 text-primary-dark font-medium text-xs sm:text-sm flex items-center justify-center gap-2.5 transition-colors">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24"><path fill="currentColor" d="M12 11v2.4h6.9c-.2 1.5-1.7 4.4-6.9 4.4-4.2 0-7.6-3.4-7.6-7.7S7.8 2.4 12 2.4c2.4 0 4 1 4.9 1.9l2.3-2.2C17.6 .5 15 0 12 0 5.4 0 0 5.4 0 12s5.4 12 12 12c6.9 0 11.5-4.9 11.5-11.7 0-.8-.1-1.4-.2-2H12z"/></svg>
                <span>Continue with Google</span>
            </button>
        </div>

        {{-- Footer Link --}}
        <p class="text-center text-xs sm:text-sm text-[#5c6b5c] mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary-dark font-bold hover:text-accent transition-colors underline decoration-[#c9a66b]/40 underline-offset-4">Create one</a>
        </p>
    </div>
</section>
@endsection