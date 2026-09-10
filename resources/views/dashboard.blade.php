@extends('layouts.app')

@section('title', 'Dashboard, GreenScape Projects')
@section('page-title', 'Dashboard')

@section('content')

    {{-- Welcome + Header Actions --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">
                Welcome back, {{ explode(' ', auth()->user()->name ?? 'Jane')[0] }}
            </h2>
            <p class="text-[#5c6b5c] text-sm mt-1">Here is a real-time overview of your landscape project's progress.</p>
        </div>
        <a href="{{ route('projects.create') }}" class="btn btn-primary inline-flex items-center gap-2 self-start sm:self-auto px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New project request
        </a>
    </div>

    {{-- Stat cards --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        @foreach ([
            ['label' => 'Project completion', 'value' => '68%', 'pill' => 'On track', 'pillClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200'],
            ['label' => 'Plants installed', 'value' => '124 / 160', 'pill' => '36 remaining', 'pillClass' => 'bg-amber-100 text-amber-800 border-amber-200'],
            ['label' => 'Budget spent', 'value' => 'KSh 1.2M', 'pill' => 'of KSh 1.8M', 'pillClass' => 'bg-slate-100 text-slate-700 border-slate-200'],
            ['label' => 'Pending approvals', 'value' => '1', 'pill' => 'Needs action', 'pillClass' => 'bg-rose-100 text-rose-800 border-rose-200'],
        ] as $stat)
            <div class="card p-6 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 hover:border-[#c9a66b]/40 transition-all group">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-xs font-semibold uppercase tracking-wider text-[#5c6b5c]">{{ $stat['label'] }}</p>
                    <span class="pill text-xs px-2.5 py-0.5 rounded-full border font-medium {{ $stat['pillClass'] }}">
                        {{ $stat['pill'] }}
                    </span>
                </div>
                <p class="font-heading text-3xl font-bold text-primary-dark tracking-tight">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Main Grid Section --}}
    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Timeline --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 lg:col-span-2">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Project timeline</h3>
                <span class="text-xs font-medium text-[#5c6b5c] bg-slate-100 px-3 py-1 rounded-full">Phase 5 of 7</span>
            </div>

            <ol class="relative border-l-2 border-[#e3dfd3]/80 ml-3.5 space-y-7">
                @php
                    $stages = [
                        ['label' => 'Inquiry', 'status' => 'done'],
                        ['label' => 'Site Visit', 'status' => 'done'],
                        ['label' => 'Concept Design', 'status' => 'done'],
                        ['label' => 'Quotation & Approval', 'status' => 'done'],
                        ['label' => 'Procurement', 'status' => 'current'],
                        ['label' => 'Planting & Finishing', 'status' => 'upcoming'],
                        ['label' => 'Client Hand-over', 'status' => 'upcoming'],
                    ];
                @endphp
                @foreach ($stages as $stage)
                    <li class="ml-6 relative group">
                        <span class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full border-2 border-white ring-2 ring-transparent transition-all
                            {{ $stage['status'] === 'done' ? 'bg-emerald-600 ring-emerald-100' : ($stage['status'] === 'current' ? 'bg-amber-500 ring-amber-100 scale-110' : 'bg-[#e3dfd3]') }}">
                        </span>

                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold {{ $stage['status'] === 'upcoming' ? 'text-[#5c6b5c]/70 font-normal' : 'text-primary-dark' }}">
                                {{ $stage['label'] }}
                            </p>
                            @if ($stage['status'] === 'done')
                                <span class="text-xs font-medium text-emerald-700 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    Completed
                                </span>
                            @elseif ($stage['status'] === 'current')
                                <span class="pill text-xs px-2.5 py-0.5 rounded-full font-medium bg-amber-100 text-amber-800 border border-amber-200 animate-pulse">
                                    In progress
                                </span>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>

        {{-- Smart Alerts --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Smart alerts</h3>
                    <span class="w-2 h-2 rounded-full bg-rose-500 animate-ping"></span>
                </div>

                <ul class="space-y-4">
                    <li class="p-3.5 rounded-xl bg-rose-50/60 border border-rose-100 flex gap-3 text-sm items-start">
                        <span class="pill bg-rose-100 text-rose-800 border-rose-200 text-xs px-2 py-0.5 rounded-md font-semibold shrink-0 mt-0.5">Action</span>
                        <span class="text-slate-700 leading-snug">Quotation revision #2 is awaiting your approval.</span>
                    </li>
                    <li class="p-3.5 rounded-xl bg-amber-50/60 border border-amber-100 flex gap-3 text-sm items-start">
                        <span class="pill bg-amber-100 text-amber-800 border-amber-200 text-xs px-2 py-0.5 rounded-md font-semibold shrink-0 mt-0.5">Update</span>
                        <span class="text-slate-700 leading-snug">36 plants remain to be installed, including 12 olive trees.</span>
                    </li>
                    <li class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 flex gap-3 text-sm items-start">
                        <span class="pill bg-slate-200 text-slate-700 text-xs px-2 py-0.5 rounded-md font-semibold shrink-0 mt-0.5">Info</span>
                        <span class="text-slate-700 leading-snug">Irrigation pressure test scheduled for Thursday.</span>
                    </li>
                </ul>
            </div>

            <button class="w-full mt-6 py-2.5 text-xs font-semibold text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 rounded-lg transition-colors">
                Dismiss resolved notifications
            </button>
        </div>
    </div>

    {{-- Plant tracking + Recent photos --}}
    <div class="grid lg:grid-cols-3 gap-8 mt-8">

        {{-- Plant Tracking Table --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 lg:col-span-2">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Plant tracking</h3>
                <a href="#" class="text-xs font-semibold text-accent hover:underline">View full inventory →</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="text-xs font-semibold uppercase tracking-wider text-[#5c6b5c] border-b border-[#e3dfd3]/80">
                            <th class="pb-3">Plant species</th>
                            <th class="pb-3 text-center">Quoted</th>
                            <th class="pb-3 text-center">Installed</th>
                            <th class="pb-3 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#e3dfd3]/50">
                        @foreach ([
                            ['name' => 'Olive Tree', 'quoted' => 12, 'installed' => 10],
                            ['name' => 'Lavender', 'quoted' => 80, 'installed' => 80],
                            ['name' => 'Agave', 'quoted' => 30, 'installed' => 24],
                            ['name' => 'Bamboo Palm', 'quoted' => 18, 'installed' => 10],
                        ] as $plant)
                            @php $remaining = $plant['quoted'] - $plant['installed']; @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3.5 font-medium text-primary-dark">{{ $plant['name'] }}</td>
                                <td class="py-3.5 text-center text-slate-600">{{ $plant['quoted'] }}</td>
                                <td class="py-3.5 text-center font-semibold text-primary-dark">{{ $plant['installed'] }}</td>
                                <td class="py-3.5 text-right">
                                    @if ($remaining > 0)
                                        <span class="pill text-xs px-2.5 py-1 rounded-full bg-amber-100 text-amber-800 border border-amber-200 font-medium">
                                            {{ $remaining }} left
                                        </span>
                                    @else
                                        <span class="pill text-xs px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200 font-medium inline-flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Complete
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Site Gallery Card --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Latest site photos</h3>
                    <span class="text-xs text-[#5c6b5c]">Updated 2d ago</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    @for ($i = 0; $i < 4; $i++)
                        <div class="group relative aspect-square rounded-xl overflow-hidden bg-gradient-to-br from-primary-light/70 to-secondary/40 border border-[#e3dfd3]/60 cursor-pointer shadow-inner">
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <a href="#" class="inline-flex items-center justify-center gap-2 text-sm text-primary-dark font-semibold hover:text-accent transition-colors mt-6 pt-4 border-t border-[#e3dfd3]/60">
                View gallery updates
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>

    </div>

@endsection
