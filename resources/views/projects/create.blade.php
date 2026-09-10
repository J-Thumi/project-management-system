@extends('layouts.app')

@section('title', 'New Project Request, GreenScape Projects')
@section('page-title', 'New Project Request')

@section('content')

    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#5c6b5c] hover:text-primary-dark transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to projects
    </a>

    <div class="mb-8">
        <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">Tell us about your project</h2>
        <p class="text-[#5c6b5c] text-sm mt-1">The more detail you share, the faster our designers can put together a concept.</p>
    </div>

    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="space-y-8" x-data="{ styles: ['Tropical'], plants: ['Olive Tree', 'Bamboo Palm'], newPlant: '' }">
        @csrf

        {{-- Basic information --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Basic information</h3>
            </div>
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="field-label">Full name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" class="field-input" required>
                </div>
                <div>
                    <label class="field-label">Phone number</label>
                    <input type="tel" name="phone" class="field-input" placeholder="+254 7xx xxx xxx" required>
                </div>
                <div>
                    <label class="field-label">Email address</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" class="field-input" required>
                </div>
                <div>
                    <label class="field-label">Property location</label>
                    <input type="text" name="location" class="field-input" placeholder="City / area" required>
                </div>
                <div>
                    <label class="field-label">Property size</label>
                    <input type="text" name="property_size" class="field-input" placeholder="e.g. 0.4 acres">
                </div>
                <div>
                    <label class="field-label">Project type</label>
                    <select name="project_type" class="field-input" required>
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
        </div>

        {{-- Budget --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Budget range</h3>
                <p class="text-sm text-[#5c6b5c] mt-1">A ballpark is fine, we'll refine it after the site visit.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3">
                @foreach ([
                    'Under KSh 500K', 'KSh 500K – 1.5M', 'KSh 1.5M – 4M', 'Above KSh 4M',
                ] as $range)
                    <label class="flex items-center gap-2.5 px-4 py-3 rounded-lg border border-[#e3dfd3] cursor-pointer hover:border-secondary has-[:checked]:border-secondary has-[:checked]:bg-secondary/10 transition-colors text-sm">
                        <input type="radio" name="budget_range" value="{{ $range }}" class="text-primary focus:ring-secondary">
                        {{ $range }}
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Preferred style --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Preferred style</h3>
                <p class="text-sm text-[#5c6b5c] mt-1">Pick as many as resonate, this guides the concept design.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                @foreach (['Tropical', 'Modern', 'Minimalist', 'Japanese', 'Mediterranean', 'Natural', 'Contemporary', 'Formal', 'Cottage'] as $style)
                    <button type="button"
                        @click="styles.includes('{{ $style }}') ? styles = styles.filter(s => s !== '{{ $style }}') : styles.push('{{ $style }}')"
                        :class="styles.includes('{{ $style }}') ? 'bg-emerald-100 text-emerald-800 border-emerald-200' : 'bg-slate-100 text-slate-700 border-slate-200 hover:border-secondary'"
                        class="pill text-xs px-3 py-1.5 rounded-full border font-medium transition-colors">
                        {{ $style }}
                    </button>
                @endforeach
            </div>
            <template x-for="style in styles" :key="style">
                <input type="hidden" name="preferred_styles[]" :value="style">
            </template>
        </div>

        {{-- Favourite plants --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Favourite plants</h3>
                <p class="text-sm text-[#5c6b5c] mt-1">Search our plant library or add your own.</p>
            </div>

            <div class="flex flex-wrap gap-2 mb-4">
                <template x-for="plant in plants" :key="plant">
                    <span class="pill text-xs px-3 py-1.5 rounded-full border font-medium bg-slate-100 text-slate-700 border-slate-200 inline-flex items-center gap-1.5">
                        <span x-text="plant"></span>
                        <button type="button" @click="plants = plants.filter(p => p !== plant)" class="text-slate-400 hover:text-rose-600">✕</button>
                    </span>
                </template>
            </div>

            <div class="flex gap-2">
                <input type="text" x-model="newPlant" @keydown.enter.prevent="if (newPlant.trim()) { plants.push(newPlant.trim()); newPlant = '' }"
                       class="field-input flex-1" placeholder="e.g. Jacaranda, Strelitzia, Agave…" list="plant-suggestions">
                <datalist id="plant-suggestions">
                    <option>Olive Tree</option><option>Jacaranda</option><option>Cycad</option>
                    <option>Agave</option><option>Strelitzia</option><option>Lavender</option>
                    <option>Bamboo</option><option>Palm Trees</option><option>Succulents</option>
                </datalist>
                <button type="button" @click="if (newPlant.trim()) { plants.push(newPlant.trim()); newPlant = '' }"
                        class="btn btn-primary !px-4">Add</button>
            </div>
            <template x-for="plant in plants" :key="plant + '-hidden'">
                <input type="hidden" name="favourite_plants[]" :value="plant">
            </template>
        </div>

        {{-- Inspiration upload --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Inspiration</h3>
                <p class="text-sm text-[#5c6b5c] mt-1">Upload images or mood boards, and drop in any links.</p>
            </div>

            <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#e3dfd3] rounded-xl py-10 cursor-pointer hover:border-secondary transition-colors mb-5">
                <svg class="w-8 h-8 text-[#5c6b5c]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                <span class="text-sm font-medium text-primary-dark">Click to upload, or drag files here</span>
                <span class="text-xs text-[#5c6b5c]">Images or PDF mood boards, up to 10MB each</span>
                <input type="file" name="inspiration_files[]" multiple accept="image/*,.pdf" class="hidden">
            </label>

            <div>
                <label class="field-label">Inspiration links</label>
                <input type="url" name="inspiration_links[]" class="field-input mb-2" placeholder="Pinterest, Instagram, or TikTok link">
            </div>
        </div>

        {{-- Notes --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Anything else?</h3>
            </div>
            <textarea name="notes" rows="4" class="field-input" placeholder="Additional requirements, constraints, or things we should know before the site visit…"></textarea>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 justify-end">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-medium text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors">
                Cancel
            </a>
            <button type="submit" class="btn btn-primary inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
                Submit request
            </button>
        </div>
    </form>

@endsection
