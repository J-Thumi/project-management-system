@extends('layouts.guest')

@section('title', 'Create your account, GreenScape Projects')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center px-6 py-16">
    <div class="w-full max-w-lg">
        <div class="text-center mb-8">
            <span class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg mx-auto mb-4">G</span>
            <h1 class="font-heading text-2xl font-bold text-primary-dark">Create your client account</h1>
            <p class="text-[#5c6b5c] text-sm mt-1">Submit a project request and track it from day one.</p>
        </div>

        <div class="card p-8">
            <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                @csrf

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="field-label">Full name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="field-input" placeholder="Jane Doe" required autofocus>
                        @error('name')<p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone" class="field-label">Phone number</label>
                        <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                               class="field-input" placeholder="+254 7xx xxx xxx" required>
                        @error('phone')<p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="field-label">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="field-input" placeholder="you@example.com" required>
                    @error('email')<p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="location" class="field-label">Property location</label>
                        <input id="location" type="text" name="location" value="{{ old('location') }}"
                               class="field-input" placeholder="City / area">
                    </div>
                    <div>
                        <label for="project_type" class="field-label">Project type</label>
                        <select id="project_type" name="project_type" class="field-input">
                            <option value="">Select type</option>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Apartment</option>
                            <option>Hotel / Resort</option>
                            <option>Office</option>
                            <option>Farm</option>
                            <option>School</option>
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="field-label">Password</label>
                        <input id="password" type="password" name="password"
                               class="field-input" placeholder="••••••••" required>
                        @error('password')<p class="text-xs text-[#b5482f] mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="field-label">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="field-input" placeholder="••••••••" required>
                    </div>
                </div>

                <label class="flex items-start gap-2 text-sm text-[#5c6b5c]">
                    <input type="checkbox" name="terms" class="mt-0.5 rounded border-[#e3dfd3] text-primary focus:ring-secondary" required>
                    I agree to the <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.
                </label>

                <button type="submit" class="btn btn-primary w-full">Create account</button>
            </form>
        </div>

        <p class="text-center text-sm text-[#5c6b5c] mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Log in</a>
        </p>
    </div>
</section>
@endsection
