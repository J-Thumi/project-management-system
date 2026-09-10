@extends('layouts.app')

@section('title', 'Messages, GreenScape Projects')
@section('page-title', 'Messages')

@section('content')

    <div class="mb-8">
        <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">Messages</h2>
        <p class="text-[#5c6b5c] text-sm mt-1">Talk directly with your project manager and design team.</p>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 overflow-hidden grid md:grid-cols-[18rem_1fr] min-h-[32rem]">

        {{-- Thread list --}}
        <div class="border-b md:border-b-0 md:border-r border-[#e3dfd3]/60 flex flex-col">
            <div class="px-5 py-4 border-b border-[#e3dfd3]/60">
                <input type="text" placeholder="Search conversations…" class="field-input !py-2 text-sm">
            </div>
            <div class="overflow-y-auto flex-1">
                @foreach ([
                    ['name' => 'Amos Kiptoo', 'role' => 'Project Manager', 'preview' => 'Quotation revision #2 is ready for your review.', 'time' => '10m', 'active' => true, 'unread' => true],
                    ['name' => 'Grace Wambui', 'role' => 'Landscape Designer', 'preview' => 'Attached the updated render for the courtyard.', 'time' => '2h', 'active' => false, 'unread' => true],
                    ['name' => 'David Mutiso', 'role' => 'Site Supervisor', 'preview' => 'Irrigation pressure test is scheduled Thursday.', 'time' => '1d', 'active' => false, 'unread' => false],
                    ['name' => 'GreenScape Support', 'role' => 'Billing', 'preview' => 'Your invoice for QT-2026-007 has been paid.', 'time' => '3d', 'active' => false, 'unread' => false],
                ] as $thread)
                    <button class="w-full text-left px-5 py-4 border-b border-[#e3dfd3]/40 hover:bg-slate-50/80 transition-colors
                        {{ $thread['active'] ? 'bg-secondary/10' : '' }}">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-semibold text-sm text-primary-dark flex items-center gap-2">
                                {{ $thread['name'] }}
                                @if ($thread['unread'])
                                    <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                @endif
                            </span>
                            <span class="text-[11px] text-[#5c6b5c] shrink-0">{{ $thread['time'] }}</span>
                        </div>
                        <p class="text-[11px] text-[#5c6b5c] mb-1">{{ $thread['role'] }}</p>
                        <p class="text-xs text-slate-600 truncate">{{ $thread['preview'] }}</p>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Active conversation --}}
        <div class="flex flex-col">
            <div class="px-6 py-4 border-b border-[#e3dfd3]/60 flex items-center gap-3">
                <span class="w-9 h-9 rounded-full bg-accent-light flex items-center justify-center font-heading font-semibold text-primary-dark text-sm">A</span>
                <div>
                    <p class="font-semibold text-sm text-primary-dark">Amos Kiptoo</p>
                    <p class="text-xs text-[#5c6b5c]">Project Manager · Ruiru Family Residence</p>
                </div>
            </div>

            <div class="flex-1 overflow-y-auto px-6 py-6 space-y-4">
                <div class="flex justify-start">
                    <div class="max-w-md bg-slate-50 border border-slate-100 rounded-2xl rounded-tl-sm px-4 py-3 text-sm text-slate-700">
                        Morning! Just a heads-up, we've finished the irrigation install ahead of schedule. Photos are up on your dashboard.
                        <p class="text-[11px] text-[#5c6b5c] mt-1.5">9:02 AM</p>
                    </div>
                </div>
                <div class="flex justify-end">
                    <div class="max-w-md bg-primary text-white rounded-2xl rounded-tr-sm px-4 py-3 text-sm">
                        That's great news, thank you! When can we expect the tree planting to start?
                        <p class="text-[11px] text-white/70 mt-1.5">9:14 AM</p>
                    </div>
                </div>
                <div class="flex justify-start">
                    <div class="max-w-md bg-slate-50 border border-slate-100 rounded-2xl rounded-tl-sm px-4 py-3 text-sm text-slate-700">
                        Quotation revision #2 is ready for your review, once approved we can start planting within 3 working days.
                        <p class="text-[11px] text-[#5c6b5c] mt-1.5">10:07 AM</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 border-t border-[#e3dfd3]/60 flex items-center gap-3">
                <input type="text" placeholder="Write a message…" class="field-input !py-2.5 text-sm flex-1">
                <button class="btn btn-primary !px-4 !py-2.5 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </div>
    </div>

@endsection
