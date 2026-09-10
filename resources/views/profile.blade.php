@extends('layouts.app')

@section('title', 'My Profile, GreenScape Projects')
@section('page-title', 'My Profile')

@section('content')

    <div class="mb-8">
        <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">My Profile</h2>
        <p class="text-[#5c6b5c] text-sm mt-1">Manage your details, preferences, and account security.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Left: avatar + summary --}}
        <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8 text-center h-fit">
            <span class="w-20 h-20 rounded-full bg-accent-light flex items-center justify-center font-heading font-bold text-2xl text-primary-dark mx-auto mb-4">
                {{ substr(auth()->user()->name ?? 'J D', 0, 1) }}
            </span>
            <h2 class="font-heading font-bold text-lg text-primary-dark">{{ auth()->user()->name ?? 'Jane Doe' }}</h2>
            <p class="text-sm text-[#5c6b5c] mb-4">{{ auth()->user()->email ?? 'jane@example.com' }}</p>
            <span class="pill text-xs px-2.5 py-0.5 rounded-full border font-medium bg-emerald-100 text-emerald-800 border-emerald-200 mb-6 inline-block">
                Active client
            </span>

            <div class="border-t border-[#e3dfd3]/60 pt-5 text-left space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-[#5c6b5c]">Phone</span>
                    <span class="font-medium text-primary-dark">+254 712 345 678</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#5c6b5c]">Location</span>
                    <span class="font-medium text-primary-dark">Ruiru, Kiambu</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#5c6b5c]">Property size</span>
                    <span class="font-medium text-primary-dark">0.4 acres</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-[#5c6b5c]">Project type</span>
                    <span class="font-medium text-primary-dark">Residential</span>
                </div>
            </div>

            <button class="w-full mt-6 py-2.5 text-xs font-semibold text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 rounded-lg transition-colors">
                Change photo
            </button>
        </div>

        {{-- Right: editable details --}}
        <div class="lg:col-span-2 space-y-8">

            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Basic information</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="field-label">Full name</label>
                            <input type="text" name="name" value="{{ auth()->user()->name ?? 'Jane Doe' }}" class="field-input">
                        </div>
                        <div>
                            <label class="field-label">Phone number</label>
                            <input type="tel" name="phone" value="+254 712 345 678" class="field-input">
                        </div>
                    </div>

                    <div>
                        <label class="field-label">Email address</label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? 'jane@example.com' }}" class="field-input">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="field-label">Property location</label>
                            <input type="text" name="location" value="Ruiru, Kiambu" class="field-input">
                        </div>
                        <div>
                            <label class="field-label">Property size</label>
                            <input type="text" name="property_size" value="0.4 acres" class="field-input">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="btn btn-primary inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
                            Save changes
                        </button>
                    </div>
                </form>
            </div>

            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8">
                <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Design preferences</h3>
                    <p class="text-sm text-[#5c6b5c] mt-1">Used by our designers when preparing your concept.</p>
                </div>

                <div class="mb-6">
                    <label class="field-label">Preferred style</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Tropical', 'Modern', 'Minimalist', 'Japanese', 'Mediterranean', 'Natural'] as $style)
                            <span class="pill text-xs px-2.5 py-1 rounded-full border font-medium
                                {{ $style === 'Tropical' ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                {{ $style }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="field-label">Favourite plants</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['Olive Tree', 'Jacaranda', 'Agave', 'Strelitzia', 'Bamboo Palm'] as $plant)
                            <span class="pill text-xs px-2.5 py-1 rounded-full border font-medium bg-slate-100 text-slate-700 border-slate-200">
                                {{ $plant }}
                            </span>
                        @endforeach
                        <button class="pill text-xs px-2.5 py-1 rounded-full border border-dashed border-[#c9a66b] text-accent font-medium hover:bg-accent-light/30 transition-colors">
                            + Add plant
                        </button>
                    </div>
                </div>
            </div>

            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8">
                <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Change password</h3>
                </div>
                <form method="POST" action="{{ route('profile.password') }}" class="grid sm:grid-cols-2 gap-5">
                    @csrf
                    <div class="sm:col-span-2">
                        <label class="field-label">Current password</label>
                        <input type="password" name="current_password" class="field-input" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="field-label">New password</label>
                        <input type="password" name="password" class="field-input" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="field-label">Confirm new password</label>
                        <input type="password" name="password_confirmation" class="field-input" placeholder="••••••••">
                    </div>
                    <div class="sm:col-span-2 pt-2">
                        <button type="submit" class="btn btn-primary inline-flex items-center gap-2 px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
                            Update password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
