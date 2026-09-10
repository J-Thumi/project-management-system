@extends('layouts.app')

@section('title', 'My Projects, GreenScape Projects')
@section('page-title', 'My Projects')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">Your projects</h2>
            <p class="text-[#5c6b5c] text-sm mt-1">Every landscape project you've commissioned, past and present.</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary inline-flex items-center gap-2 self-start sm:self-auto px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New project request
        </a>
    </div>

    <div x-data="{
        filter: 'all',
        projects: [
            { slug: 'ruiru-family-residence', name: 'Ruiru Family Residence', type: 'Residential · 0.4 acres', status: 'In progress', statusClass: 'bg-amber-100 text-amber-800 border-amber-200', progress: 68, stage: 'Procurement', updated: '2 days ago', group: 'active' },
            { slug: 'karen-boutique-hotel-grounds', name: 'Karen Boutique Hotel Grounds', type: 'Hospitality · 2.1 acres', status: 'Awaiting approval', statusClass: 'bg-rose-100 text-rose-800 border-rose-200', progress: 22, stage: 'Quotation & Approval', updated: '5 hours ago', group: 'active' },
            { slug: 'westlands-office-courtyard', name: 'Westlands Office Courtyard', type: 'Commercial · 0.2 acres', status: 'Completed', statusClass: 'bg-emerald-100 text-emerald-800 border-emerald-200', progress: 100, stage: 'Handed over', updated: '3 weeks ago', group: 'completed' },
            { slug: 'nakuru-farmhouse-garden', name: 'Nakuru Farmhouse Garden', type: 'Residential · 1.8 acres', status: 'Draft', statusClass: 'bg-slate-100 text-slate-700 border-slate-200', progress: 0, stage: 'Not yet submitted', updated: '1 week ago', group: 'draft' },
        ]
    }">
        {{-- Filter tabs --}}
        <div class="flex items-center gap-2 mb-6 border-b border-[#e3dfd3]/60">
            <template x-for="tab in [
                { key: 'all', label: 'All' },
                { key: 'active', label: 'Active' },
                { key: 'completed', label: 'Completed' },
                { key: 'draft', label: 'Draft' },
            ]" :key="tab.key">
                <button @click="filter = tab.key"
                    :class="filter === tab.key ? 'border-primary text-primary-dark' : 'border-transparent text-[#5c6b5c] hover:text-primary-dark'"
                    class="px-4 py-2.5 text-sm font-semibold border-b-2 transition-colors"
                    x-text="tab.label">
                </button>
            </template>
        </div>

        <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-6">
            <template x-for="project in projects.filter(p => filter === 'all' || p.group === filter)" :key="project.slug">
                <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 hover:border-[#c9a66b]/40 hover:shadow-md transition-all overflow-hidden group">
                    <a :href="`{{ url('/projects') }}/${project.slug}`" class="block aspect-[16/9] bg-gradient-to-br from-primary-light/70 to-secondary/40 relative">
                        <span class="absolute top-3 right-3 pill text-xs px-2.5 py-0.5 rounded-full border font-medium" :class="project.statusClass" x-text="project.status"></span>
                    </a>
                    <div class="p-6">
                        <a :href="`{{ url('/projects') }}/${project.slug}`" class="hover:text-accent transition-colors">
                            <h3 class="font-heading font-bold text-lg text-primary-dark mb-1" x-text="project.name"></h3>
                        </a>
                        <p class="text-xs text-[#5c6b5c] mb-4" x-text="project.type"></p>

                        <div class="mb-4">
                            <div class="flex items-center justify-between text-xs font-medium mb-1.5">
                                <span class="text-[#5c6b5c]" x-text="project.stage"></span>
                                <span class="text-primary-dark" x-text="project.progress + '%'"></span>
                            </div>
                            <div class="h-1.5 rounded-full bg-slate-100 overflow-hidden">
                                <div class="h-full rounded-full bg-secondary" :style="`width: ${project.progress}%`"></div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-[#e3dfd3]/60">
                            <span class="text-xs text-[#5c6b5c]" x-text="'Updated ' + project.updated"></span>
                            <a :href="`{{ url('/projects') }}/${project.slug}`" class="text-xs font-semibold text-primary hover:text-accent transition-colors">View details →</a>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Empty-state / add-new card --}}
            <a href="{{ route('projects.create') }}" class="card rounded-2xl border-2 border-dashed border-[#e3dfd3] flex flex-col items-center justify-center text-center p-10 text-[#5c6b5c] hover:border-secondary hover:text-primary-dark transition-colors min-h-[280px]">
                <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16m8-8H4"/></svg>
                <p class="text-sm font-semibold">Start a new project</p>
                <p class="text-xs mt-1 max-w-[16rem]">Tell us about your space and we'll schedule a site visit.</p>
            </a>
        </div>

        {{-- Empty filter state --}}
        <div x-show="projects.filter(p => filter === 'all' || p.group === filter).length === 0" x-cloak
             class="text-center py-16 text-[#5c6b5c]">
            <p class="text-sm">No projects in this category yet.</p>
        </div>
    </div>

@endsection
