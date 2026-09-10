@extends('layouts.app')

@section('title', $project['name'] . ', GreenScape Projects')
@section('page-title', 'Project Details')

@section('content')

    {{-- Back link + header --}}
    <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#5c6b5c] hover:text-primary-dark transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to projects
    </a>

    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3 mb-1.5">
                <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">{{ $project['name'] }}</h2>
                <span class="pill text-xs px-2.5 py-0.5 rounded-full border font-medium {{ $project['statusClass'] }}">
                    {{ $project['status'] }}
                </span>
            </div>
            <p class="text-[#5c6b5c] text-sm">{{ $project['type'] }} · Started {{ $project['started'] }}</p>
        </div>
        <div class="flex gap-3 self-start">
            <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg font-medium text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                Message team
            </button>
            <a href="{{ route('quotations.index') }}" class="btn btn-primary inline-flex items-center gap-2 px-4 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
                View quotation
            </a>
        </div>
    </div>

    {{-- Stat cards --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        @foreach ([
            ['label' => 'Overall completion', 'value' => $project['progress'] . '%', 'pill' => $project['stage'], 'pillClass' => 'bg-amber-100 text-amber-800 border-amber-200'],
            ['label' => 'Plants installed', 'value' => '124 / 160', 'pill' => '36 remaining', 'pillClass' => 'bg-amber-100 text-amber-800 border-amber-200'],
            ['label' => 'Budget spent', 'value' => 'KSh 1.2M', 'pill' => 'of KSh 1.8M', 'pillClass' => 'bg-slate-100 text-slate-700 border-slate-200'],
            ['label' => 'Next site visit', 'value' => 'Thu, Sep 12', 'pill' => 'Confirmed', 'pillClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200'],
        ] as $stat)
            <div class="card p-6 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
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

    <div class="grid lg:grid-cols-3 gap-8 mb-8">

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

        {{-- Project info --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Project info</h3>
            </div>
            <dl class="space-y-4 text-sm">
                <div class="flex justify-between">
                    <dt class="text-[#5c6b5c]">Property size</dt>
                    <dd class="font-medium text-primary-dark">{{ $project['size'] }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-[#5c6b5c]">Design style</dt>
                    <dd class="font-medium text-primary-dark">{{ $project['style'] }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-[#5c6b5c]">Project manager</dt>
                    <dd class="font-medium text-primary-dark">Amos Kiptoo</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-[#5c6b5c]">Site supervisor</dt>
                    <dd class="font-medium text-primary-dark">David Mutiso</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-[#5c6b5c]">Est. completion</dt>
                    <dd class="font-medium text-primary-dark">{{ $project['eta'] }}</dd>
                </div>
            </dl>
        </div>
    </div>

    {{-- Plant tracking --}}
    <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 mb-8">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
            <h3 class="font-heading font-bold text-xl text-primary-dark">Plant tracking</h3>
            <span class="text-xs font-medium text-[#5c6b5c] bg-slate-100 px-3 py-1 rounded-full">4 species</span>
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

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Site photo gallery --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 lg:col-span-2">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Site photos</h3>
                <span class="text-xs text-[#5c6b5c]">Updated 2d ago</span>
            </div>
            <div class="grid grid-cols-3 gap-3">
                @for ($i = 0; $i < 6; $i++)
                    <div class="group relative aspect-square rounded-xl overflow-hidden bg-gradient-to-br from-primary-light/70 to-secondary/40 border border-[#e3dfd3]/60 cursor-pointer shadow-inner">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                            <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        {{-- Activity feed --}}
        <div class="card p-6 lg:p-8 bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-[#e3dfd3]/60">
                <h3 class="font-heading font-bold text-xl text-primary-dark">Recent activity</h3>
            </div>
            <ul class="space-y-5">
                @foreach ([
                    ['label' => 'Irrigation installed', 'time' => 'Today, 9:02 AM'],
                    ['label' => 'Site cleared', 'time' => 'Sep 5, 2026'],
                    ['label' => 'Quotation revision #2 sent', 'time' => 'Sep 3, 2026'],
                    ['label' => 'Site visit completed', 'time' => 'Aug 28, 2026'],
                ] as $event)
                    <li class="flex gap-3">
                        <span class="w-2 h-2 rounded-full bg-secondary mt-1.5 shrink-0"></span>
                        <div>
                            <p class="text-sm font-medium text-primary-dark">{{ $event['label'] }}</p>
                            <p class="text-xs text-[#5c6b5c]">{{ $event['time'] }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
