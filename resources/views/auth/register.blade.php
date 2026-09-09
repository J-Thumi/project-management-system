@extends('layouts.guest')

@section('title', 'Create your account — GreenScape Projects')

@section('content')
<section class="min-h-[calc(100vh-64px)] flex items-center justify-center px-6 py-12 lg:py-16 bg-gradient-to-b from-[#eef3e6]/60 via-[#f5f8f2]/40 to-white relative overflow-hidden">
    {{-- Decorative Background Glow --}}
    <div class="absolute -top-20 -right-20 w-80 h-80 bg-secondary/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-accent-light/30 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10">
        {{-- Header Section --}}
        <div class="text-center mb-8">
            <span class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-dark to-primary flex items-center justify-center text-white font-heading font-bold text-xl mx-auto mb-4 shadow-md shadow-primary-dark/15 border border-white/20">
                G
            </span>
            <h1 class="font-heading text-2xl sm:text-3xl font-bold text-primary-dark tracking-tight">Create your client account</h1>
            <p class="text-[#5c6b5c] text-sm mt-1.5">Submit a project request and track it from day one.</p>
        </div>

        {{-- Card Container --}}
        <div class="card p-7 sm:p-9 bg-white/90 backdrop-blur-md rounded-2xl shadow-xl shadow-primary-dark/5 border border-[#e3dfd3]/80">
            <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                @csrf

                {{-- Name & Phone --}}
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="name" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Full name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}"
                               class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                               placeholder="Jane Doe" required autofocus>
                        @error('name')
                            <p class="text-xs text-rose-600 font-medium mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Phone number</label>
                        <input id="phone" type="tel" name="phone" value="{{ old('phone') }}"
                               class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                               placeholder="+254 7xx xxx xxx" required>
                        @error('phone')
                            <p class="text-xs text-rose-600 font-medium mt-1.5 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Email address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="you@example.com" required>
                    @error('email')
                        <p class="text-xs text-rose-600 font-medium mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Location & Project Type --}}
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="location" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Property location</label>
                        <input id="location" type="text" name="location" value="{{ old('location') }}"
                               class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                               placeholder="City / area">
                    </div>
                    <div>
                        <label for="project_type" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Project type</label>
                        <select id="project_type" name="project_type" class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark">
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

                {{-- Password Fields --}}
                <div class="grid sm:grid-cols-2 gap-5">
                    <div>
                        <label for="password" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Password</label>
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
                    <div>
                        <label for="password_confirmation" class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Confirm password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                               placeholder="••••••••" required>
                    </div>
                </div>

                {{-- Terms Checkbox --}}
                <div class="pt-1">
                    <label class="flex items-start gap-2.5 text-xs sm:text-sm text-[#5c6b5c] cursor-pointer select-none leading-normal">
                        <input type="checkbox" name="terms" class="mt-0.5 w-4 h-4 rounded border-[#e3dfd3] text-primary focus:ring-2 focus:ring-accent/20 accent-emerald-700 transition shrink-0" required>
                        <span>I agree to the <a href="#" class="text-primary-dark font-semibold hover:text-accent underline decoration-[#c9a66b]/40">Terms of Service</a> and <a href="#" class="text-primary-dark font-semibold hover:text-accent underline decoration-[#c9a66b]/40">Privacy Policy</a>.</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary w-full py-3 rounded-xl font-medium shadow-md shadow-primary-dark/10 hover:shadow-lg transition-all transform hover:-translate-y-0.5 mt-2">
                    Create account
                </button>
            </form>
        </div>

        {{-- Footer Link --}}
        <p class="text-center text-xs sm:text-sm text-[#5c6b5c] mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary-dark font-bold hover:text-accent transition-colors underline decoration-[#c9a66b]/40 underline-offset-4">Log in</a>
        </p>
    </div>
</section>
@endsection