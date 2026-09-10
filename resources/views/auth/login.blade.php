@extends('layouts.guest')

@section('title', 'Log in, GreenScape Projects')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center px-6 py-16">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <span class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg mx-auto mb-4">G</span>
            <h1 class="font-heading text-2xl font-bold text-primary-dark">Welcome back</h1>
            <p class="text-[#5c6b5c] text-sm mt-1">Log in to track your landscape project.</p>
        </div>

        <div class="card p-8">

            @if (session('status'))
                <div class="mb-5 text-sm rounded-md bg-secondary/15 text-primary-dark px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="field-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="field-input" placeholder="you@example.com" required autofocus>
                    @error('email')
                        <p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="field-label">Password</label>
                        <a href="{{ route('password.request') }}" class="text-xs text-primary hover:underline">Forgot password?</a>
                    </div>
                    <input id="password" type="password" name="password"
                           class="field-input" placeholder="••••••••" required>
                    @error('password')
                        <p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-2 text-sm text-[#5c6b5c]">
                    <input type="checkbox" name="remember" class="rounded border-[#e3dfd3] text-primary focus:ring-secondary">
                    Keep me signed in
                </label>

                <button type="submit" class="btn btn-primary w-full">Log in</button>
            </form>

            <div class="flex items-center gap-3 my-6">
                <span class="h-px bg-[#e3dfd3] flex-1"></span>
                <span class="text-xs text-[#5c6b5c]">or</span>
                <span class="h-px bg-[#e3dfd3] flex-1"></span>
            </div>

            <button class="btn btn-outline w-full">
                <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="currentColor" d="M12 11v2.4h6.9c-.2 1.5-1.7 4.4-6.9 4.4-4.2 0-7.6-3.4-7.6-7.7S7.8 2.4 12 2.4c2.4 0 4 1 4.9 1.9l2.3-2.2C17.6 .5 15 0 12 0 5.4 0 0 5.4 0 12s5.4 12 12 12c6.9 0 11.5-4.9 11.5-11.7 0-.8-.1-1.4-.2-2H12z"/></svg>
                Continue with Google
            </button>
        </div>

        <p class="text-center text-sm text-[#5c6b5c] mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Create one</a>
        </p>
    </div>
</section>
@endsection
