@extends('layouts.app')

@section('title', 'Notifications, GreenScape Projects')
@section('page-title', 'Notifications')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">Notifications</h2>
            <p class="text-[#5c6b5c] text-sm mt-1">Updates on your projects, quotations, and messages.</p>
        </div>
        <button class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg font-medium text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Mark all as read
        </button>
    </div>

    @php
        $groups = [
            'Today' => [
                ['type' => 'Action', 'typeClass' => 'bg-rose-100 text-rose-800 border-rose-200', 'text' => 'Quotation revision #2 for Karen Boutique Hotel is awaiting your approval.', 'time' => '10:07 AM', 'unread' => true, 'link' => 'quotations.index'],
                ['type' => 'Update', 'typeClass' => 'bg-amber-100 text-amber-800 border-amber-200', 'text' => 'New site photos uploaded for Ruiru Family Residence.', 'time' => '9:02 AM', 'unread' => true, 'link' => 'dashboard'],
            ],
            'This week' => [
                ['type' => 'Update', 'typeClass' => 'bg-amber-100 text-amber-800 border-amber-200', 'text' => '36 plants remain to be installed at Ruiru Family Residence, including 12 olive trees.', 'time' => 'Tue, 2:15 PM', 'unread' => false, 'link' => 'dashboard'],
                ['type' => 'Info', 'typeClass' => 'bg-slate-200 text-slate-700 border-slate-200', 'text' => 'Irrigation pressure test scheduled for Thursday at Ruiru Family Residence.', 'time' => 'Mon, 11:40 AM', 'unread' => false, 'link' => 'dashboard'],
                ['type' => 'Message', 'typeClass' => 'bg-sky-100 text-sky-800 border-sky-200', 'text' => 'Grace Wambui sent you an updated render for the courtyard.', 'time' => 'Mon, 8:55 AM', 'unread' => false, 'link' => 'messages.index'],
            ],
            'Earlier' => [
                ['type' => 'Payment', 'typeClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200', 'text' => 'Your invoice for QT-2026-007 (Westlands Office Courtyard) has been paid.', 'time' => 'Sep 3, 2026', 'unread' => false, 'link' => 'quotations.index'],
                ['type' => 'Update', 'typeClass' => 'bg-amber-100 text-amber-800 border-amber-200', 'text' => 'Site cleared at Ruiru Family Residence, planting phase begins next.', 'time' => 'Sep 1, 2026', 'unread' => false, 'link' => 'dashboard'],
                ['type' => 'Info', 'typeClass' => 'bg-slate-200 text-slate-700 border-slate-200', 'text' => 'Westlands Office Courtyard project was marked complete.', 'time' => 'Aug 20, 2026', 'unread' => false, 'link' => 'dashboard'],
            ],
        ];
    @endphp

    <div class="space-y-8">
        @foreach ($groups as $label => $items)
            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 overflow-hidden">
                <div class="px-6 lg:px-8 py-4 border-b border-[#e3dfd3]/60">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-[#5c6b5c]">{{ $label }}</h3>
                </div>
                <ul class="divide-y divide-[#e3dfd3]/50">
                    @foreach ($items as $note)
                        <li>
                            <a href="{{ route($note['link']) }}" class="flex items-start gap-4 px-6 lg:px-8 py-4 hover:bg-slate-50/80 transition-colors">
                                <span class="pill text-xs px-2.5 py-0.5 rounded-full border font-medium shrink-0 mt-0.5 {{ $note['typeClass'] }}">
                                    {{ $note['type'] }}
                                </span>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-slate-700 leading-snug">{{ $note['text'] }}</p>
                                    <p class="text-[11px] text-[#5c6b5c] mt-1">{{ $note['time'] }}</p>
                                </div>
                                @if ($note['unread'])
                                    <span class="w-2 h-2 rounded-full bg-secondary shrink-0 mt-2"></span>
                                @endif
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

@endsection
