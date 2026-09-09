@extends('layouts.app')

@section('title', 'My Profile — GreenScape Projects')
@section('page-title', 'My Profile')

@section('content')

    <div class="grid lg:grid-cols-3 gap-8 items-start">

        {{-- Left: Avatar & Quick Info Summary --}}
        <div class="card p-6 lg:p-8 text-center bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 sticky top-6">
            {{-- Avatar with Status Badge Overlay --}}
            <div class="relative w-24 h-24 mx-auto mb-4">
                <span class="w-full h-full rounded-full bg-accent-light/60 border-2 border-primary-dark/10 flex items-center justify-center font-heading font-bold text-3xl text-primary-dark shadow-inner">
                    {{ substr(auth()->user()->name ?? 'J D', 0, 1) }}
                </span>
                <span class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full" title="Active"></span>
            </div>

            <h2 class="font-heading font-semibold text-xl text-primary-dark tracking-tight">{{ auth()->user()->name ?? 'Jane Doe' }}</h2>
            <p class="text-sm text-[#5c6b5c] mb-3">{{ auth()->user()->email ?? 'jane@example.com' }}</p>
            <span class="pill pill-success text-xs px-3 py-1 font-medium tracking-wide rounded-full">Active client</span>

            {{-- Client Metadata Summary --}}
            <div class="border-t border-[#e3dfd3]/80 my-6 pt-6 text-left space-y-3.5 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-[#5c6b5c] font-medium">Phone</span>
                    <span class="font-semibold text-primary-dark">+254 712 345 678</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#5c6b5c] font-medium">Location</span>
                    <span class="font-semibold text-primary-dark">Ruiru, Kiambu</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#5c6b5c] font-medium">Property size</span>
                    <span class="font-semibold text-primary-dark">0.4 acres</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[#5c6b5c] font-medium">Project type</span>
                    <span class="font-semibold text-primary-dark">Residential</span>
                </div>
            </div>

            <button class="btn btn-outline w-full py-2.5 text-sm font-medium border-[#c9a66b] text-primary-dark hover:bg-[#c9a66b]/10 transition-colors duration-200">
                Change photo
            </button>
        </div>

        {{-- Right: Form Details & Settings --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Card 1: Basic Information --}}
            <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
                <div class="mb-6 border-b border-[#e3dfd3]/60 pb-4">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Basic information</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Manage your core account details and location information.</p>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Full name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? 'Jane Doe' }}" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition">
                        </div>
                        <div>
                            <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Phone number</label>
                            <input type="tel" name="phone" value="+254 712 345 678" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition">
                        </div>
                    </div>

                    <div>
                        <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Email address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? 'jane@example.com' }}" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Property location</label>
                            <input type="text" name="location" value="Ruiru, Kiambu" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition">
                        </div>
                        <div>
                            <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Property size</label>
                            <input type="text" name="property_size" value="0.4 acres" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary px-6 py-2.5 font-medium rounded-lg shadow-sm hover:shadow transition-all">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            {{-- Card 2: Design Preferences --}}
            <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
                <div class="mb-6 border-b border-[#e3dfd3]/60 pb-4">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Design preferences</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Used by our landscape architects when preparing initial site concepts.</p>
                </div>

                <div class="mb-6">
                    <label class="field-label font-medium text-sm text-primary-dark mb-2.5 block">Preferred style</label>
                    <div class="flex flex-wrap gap-2.5">
                        @foreach (['Tropical', 'Modern', 'Minimalist', 'Japanese', 'Mediterranean', 'Natural'] as $style)
                            <button type="button" class="pill px-3.5 py-1.5 rounded-full text-xs font-medium cursor-pointer transition-transform active:scale-95 {{ $style === 'Tropical' ? 'pill-success bg-emerald-100 text-emerald-800 border border-emerald-200' : 'pill-muted bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                {{ $style }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="field-label font-medium text-sm text-primary-dark mb-2.5 block">Favourite plants</label>
                    <div class="flex flex-wrap gap-2.5 items-center">
                        @foreach (['Olive Tree', 'Jacaranda', 'Agave', 'Strelitzia', 'Bamboo Palm'] as $plant)
                            <span class="pill pill-muted px-3.5 py-1.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                {{ $plant }}
                            </span>
                        @endforeach
                        <button type="button" class="pill border border-dashed border-[#c9a66b] text-accent hover:bg-[#c9a66b]/10 px-3.5 py-1.5 rounded-full text-xs font-medium transition-colors">
                            + Add plant
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card 3: Change Password --}}
            <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
                <div class="mb-6 border-b border-[#e3dfd3]/60 pb-4">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Change password</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Ensure your account remains secure with a strong password.</p>
                </div>

                <form method="POST" action="{{ route('profile.password') }}" class="grid sm:grid-cols-2 gap-6">
                    @csrf
                    <div class="sm:col-span-2">
                        <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Current password</label>
                        <input type="password" name="current_password" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">New password</label>
                        <input type="password" name="password" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="field-label font-medium text-sm text-primary-dark mb-1.5 block">Confirm new password</label>
                        <input type="password" name="password_confirmation" class="field-input w-full px-4 py-2.5 rounded-lg border border-[#e3dfd3] focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition" placeholder="••••••••">
                    </div>
                    <div class="sm:col-span-2 pt-2">
                        <button type="submit" class="btn btn-primary px-6 py-2.5 font-medium rounded-lg shadow-sm hover:shadow transition-all">
                            Update password
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection