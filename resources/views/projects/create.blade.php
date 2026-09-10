@extends('layouts.app')

@section('title', 'New Project Request — GreenScape Projects')
@section('page-title', 'New Project Request')

@section('content')

    {{-- Back Link --}}
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-xs sm:text-sm font-semibold text-[#5c6b5c] hover:text-primary-dark transition-colors mb-6 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to projects
    </a>

    {{-- Page Header --}}
    <div class="mb-8">
        <span class="text-xs font-semibold uppercase tracking-wider text-accent block mb-1">Project Onboarding</span>
        <h2 class="font-heading text-2xl sm:text-3xl lg:text-4xl font-bold text-primary-dark tracking-tight">Tell us about your project</h2>
        <p class="text-[#5c6b5c] text-sm sm:text-base mt-1.5 max-w-2xl leading-relaxed">The more details you share, the faster our landscape designers can craft a personalized visual concept.</p>
    </div>

    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data" class="space-y-8 max-w-5xl" 
          x-data="{ 
              styles: ['Tropical'], 
              plants: ['Olive Tree', 'Bamboo Palm'], 
              newPlant: '',
              links: [''],
              files: [],
              handleFileDrop(e) {
                  this.files = Array.from(e.dataTransfer ? e.dataTransfer.files : e.target.files);
              }
          }">
        @csrf

        {{-- 1. Basic information --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">1. Basic Information</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Your contact details and property specifics.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">01</span>
            </div>
            
            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Full name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? '' }}" 
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" required>
                </div>
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Phone number</label>
                    <input type="tel" name="phone" 
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="+254 7xx xxx xxx" required>
                </div>
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Email address</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" 
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" required>
                </div>
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Property location</label>
                    <input type="text" name="location" 
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="City / area (e.g. Karen, Nairobi)" required>
                </div>
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Property size</label>
                    <input type="text" name="property_size" 
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="e.g. 0.4 acres / 500 sq m">
                </div>
                <div>
                    <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Project type</label>
                    <select name="project_type" class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark" required>
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

        {{-- 2. Budget Range --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">2. Budget Range</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">A ballpark helps us tailor plant selection and hardscaping materials.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">02</span>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-3.5">
                @foreach ([
                    'Under KSh 500K', 'KSh 500K – 1.5M', 'KSh 1.5M – 4M', 'Above KSh 4M',
                ] as $range)
                    <label class="relative flex items-center justify-between px-4 py-3.5 rounded-xl border border-[#e3dfd3] bg-slate-50/30 cursor-pointer hover:border-accent hover:bg-emerald-50/20 has-[:checked]:border-emerald-700 has-[:checked]:bg-emerald-50/60 has-[:checked]:ring-1 has-[:checked]:ring-emerald-700 transition-all text-xs sm:text-sm font-medium text-primary-dark select-none group">
                        <span>{{ $range }}</span>
                        <input type="radio" name="budget_range" value="{{ $range }}" class="w-4 h-4 text-emerald-700 focus:ring-accent accent-emerald-700">
                    </label>
                @endforeach
            </div>
        </div>

        {{-- 3. Preferred Style --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">3. Preferred Style</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Select all design directions that match your vision.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">03</span>
            </div>

            <div class="flex flex-wrap gap-2.5">
                @foreach (['Tropical', 'Modern', 'Minimalist', 'Japanese', 'Mediterranean', 'Natural', 'Contemporary', 'Formal', 'Cottage'] as $style)
                    <button type="button"
                        @click="styles.includes('{{ $style }}') ? styles = styles.filter(s => s !== '{{ $style }}') : styles.push('{{ $style }}')"
                        :class="styles.includes('{{ $style }}') 
                            ? 'bg-emerald-700 text-white border-emerald-700 shadow-xs' 
                            : 'bg-slate-50 text-slate-700 border-[#e3dfd3] hover:border-accent hover:bg-slate-100'"
                        class="text-xs sm:text-sm px-4 py-2 rounded-xl border font-medium transition-all flex items-center gap-1.5 select-none">
                        <span x-text="styles.includes('{{ $style }}') ? '✓' : '+'" class="text-xs font-bold"></span>
                        <span>{{ $style }}</span>
                    </button>
                @endforeach
            </div>
            
            <template x-for="style in styles" :key="style">
                <input type="hidden" name="preferred_styles[]" :value="style">
            </template>
        </div>

        {{-- 4. Favourite Plants --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">4. Favourite Plants</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Search our library or type custom species you'd love to incorporate.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">04</span>
            </div>

            {{-- Selected Plant Tags --}}
            <div class="flex flex-wrap gap-2 mb-4" x-show="plants.length > 0">
                <template x-for="plant in plants" :key="plant">
                    <span class="text-xs px-3 py-1.5 rounded-lg border font-medium bg-emerald-50 text-emerald-900 border-emerald-200/80 inline-flex items-center gap-2 shadow-2xs">
                        <span x-text="plant"></span>
                        <button type="button" @click="plants = plants.filter(p => p !== plant)" class="text-emerald-700 hover:text-rose-600 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </span>
                </template>
            </div>

            {{-- Add Plant Input --}}
            <div class="flex gap-2.5">
                <div class="relative flex-1">
                    <input type="text" x-model="newPlant" 
                           @keydown.enter.prevent="if (newPlant.trim() && !plants.includes(newPlant.trim())) { plants.push(newPlant.trim()); newPlant = '' }"
                           class="field-input w-full px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                           placeholder="Type plant name (e.g. Jacaranda, Strelitzia, Agave...)" list="plant-suggestions">
                    <datalist id="plant-suggestions">
                        <option>Olive Tree</option><option>Jacaranda</option><option>Cycad</option>
                        <option>Agave</option><option>Strelitzia</option><option>Lavender</option>
                        <option>Bamboo</option><option>Palm Trees</option><option>Succulents</option>
                    </datalist>
                </div>
                <button type="button" 
                        @click="if (newPlant.trim() && !plants.includes(newPlant.trim())) { plants.push(newPlant.trim()); newPlant = '' }"
                        class="btn btn-primary px-5 py-2.5 rounded-xl font-medium text-xs sm:text-sm shadow-sm hover:shadow transition-all shrink-0">
                    Add Plant
                </button>
            </div>

            <template x-for="plant in plants" :key="plant + '-hidden'">
                <input type="hidden" name="favourite_plants[]" :value="plant">
            </template>
        </div>

        {{-- 5. Inspiration & Mood Board --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">5. Inspiration & Links</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Upload existing site photos, PDF blueprints, or external mood board links.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">05</span>
            </div>

            {{-- File Upload Box --}}
            <label @dragover.prevent @drop.prevent="handleFileDrop($event)"
                   class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-[#e3dfd3] hover:border-accent bg-slate-50/30 hover:bg-emerald-50/20 rounded-2xl py-8 px-6 cursor-pointer transition-all mb-6 group text-center">
                <div class="w-12 h-12 rounded-2xl bg-slate-100 group-hover:bg-emerald-100/60 text-[#5c6b5c] group-hover:text-emerald-800 flex items-center justify-center transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                </div>
                <div>
                    <span class="text-xs sm:text-sm font-semibold text-primary-dark group-hover:text-emerald-900 block">Click to upload or drag & drop files</span>
                    <span class="text-[11px] text-[#5c6b5c]">Supports JPEG, PNG, or PDF mood boards (Up to 10MB per file)</span>
                </div>
                <input type="file" name="inspiration_files[]" multiple accept="image/*,.pdf" class="hidden" @change="handleFileDrop($event)">
            </label>

            {{-- Selected File List Preview --}}
            <template x-if="files.length > 0">
                <div class="mb-6 space-y-2">
                    <p class="text-xs font-semibold text-primary-dark">Attached Files:</p>
                    <div class="flex flex-wrap gap-2">
                        <template x-for="(file, index) in files" :key="index">
                            <span class="text-xs px-3 py-1.5 rounded-lg border bg-slate-50 border-[#e3dfd3] text-primary-dark flex items-center gap-2">
                                📄 <span x-text="file.name" class="max-w-[200px] truncate"></span>
                            </span>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Dynamic Inspiration Links --}}
            <div>
                <label class="field-label font-medium text-xs sm:text-sm text-primary-dark mb-1.5 block">Inspiration links</label>
                <div class="space-y-2.5">
                    <template x-for="(link, index) in links" :key="index">
                        <div class="flex gap-2">
                            <input type="url" name="inspiration_links[]" x-model="links[index]"
                                   class="field-input flex-1 px-4 py-2.5 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                                   placeholder="https://pinterest.com/pin/..., Instagram, or TikTok link">
                            <button type="button" x-show="links.length > 1" @click="links.splice(index, 1)" 
                                    class="px-3 py-2 text-slate-400 hover:text-rose-600 transition-colors">
                                ✕
                            </button>
                        </div>
                    </template>
                </div>
                <button type="button" @click="links.push('')" class="mt-2.5 text-xs font-semibold text-primary-dark hover:text-accent transition-colors flex items-center gap-1">
                    <span>+ Add another link</span>
                </button>
            </div>
        </div>

        {{-- 6. Additional Notes --}}
        <div class="card p-6 sm:p-8 bg-white/90 backdrop-blur-sm rounded-2xl shadow-sm border border-[#e3dfd3]/80 hover:border-[#e3dfd3] transition-all">
            <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60 flex items-center justify-between">
                <div>
                    <h3 class="font-heading font-bold text-xl text-primary-dark">6. Additional Notes</h3>
                    <p class="text-xs text-[#5c6b5c] mt-0.5">Share site access details, drainage concerns, or specific constraints.</p>
                </div>
                <span class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 font-bold text-xs flex items-center justify-center shrink-0">06</span>
            </div>

            <textarea name="notes" rows="4" 
                      class="field-input w-full px-4 py-3 rounded-xl border border-[#e3dfd3] bg-slate-50/50 focus:bg-white focus:border-accent focus:ring-2 focus:ring-accent/20 outline-none transition text-sm text-primary-dark placeholder-[#5c6b5c]/50" 
                      placeholder="e.g. Property has a steep slope, existing dog run to preserve, preference for low-maintenance irrigation..."></textarea>
        </div>

        {{-- Form Actions --}}
        <div class="flex flex-col-reverse sm:flex-row gap-3.5 justify-end pt-4">
            <a href="{{ route('projects.index') }}" 
               class="px-6 py-3 rounded-xl font-medium text-xs sm:text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors text-center">
                Cancel
            </a>
            <button type="submit" 
                    class="btn btn-primary px-8 py-3 rounded-xl font-medium text-xs sm:text-sm shadow-md shadow-primary-dark/10 hover:shadow-lg transition-all transform hover:-translate-y-0.5 text-center">
                Submit project request
            </button>
        </div>
    </form>

@endsection