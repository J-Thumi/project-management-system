@extends('layouts.app')

@section('title', $quotation['ref'] . ', GreenScape Projects')
@section('page-title', 'Quotation Details')

@section('content')

    <a href="{{ route('quotations.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-[#5c6b5c] hover:text-primary-dark transition-colors mb-5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to quotations
    </a>

    <div class="grid lg:grid-cols-3 gap-8">

        {{-- Main column --}}
        <div class="lg:col-span-2 space-y-8">

            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8">
                <div class="flex flex-wrap items-start justify-between gap-3 mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <div>
                        <p class="font-mono text-xs font-semibold text-[#5c6b5c] mb-1">{{ $quotation['ref'] }}</p>
                        <h2 class="font-heading text-2xl font-bold text-primary-dark tracking-tight">{{ $quotation['project'] }}</h2>
                        <p class="text-xs text-[#5c6b5c] mt-1">Sent {{ $quotation['date'] }}</p>
                    </div>
                    <span class="pill text-xs px-2.5 py-0.5 rounded-full border font-medium {{ $quotation['statusClass'] }}">
                        {{ $quotation['status'] }}
                    </span>
                </div>

                <div class="overflow-x-auto mb-6">
                    <table class="w-full text-sm text-left">
                        <thead>
                            <tr class="text-xs font-semibold uppercase tracking-wider text-[#5c6b5c] border-b border-[#e3dfd3]/80">
                                <th class="pb-3">Item</th>
                                <th class="pb-3 text-center">Qty</th>
                                <th class="pb-3 text-right">Unit price</th>
                                <th class="pb-3 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e3dfd3]/50">
                            @foreach ($quotation['items'] as $item)
                                <tr>
                                    <td class="py-3">
                                        <p class="font-medium text-primary-dark">{{ $item['item'] }}</p>
                                        <p class="text-xs text-[#5c6b5c]">{{ $item['category'] }}</p>
                                    </td>
                                    <td class="py-3 text-center text-slate-600">{{ $item['qty'] }}</td>
                                    <td class="py-3 text-right text-slate-600">{{ $item['unit'] }}</td>
                                    <td class="py-3 text-right font-semibold text-primary-dark">{{ $item['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-[#e3dfd3]">
                                <td colspan="3" class="pt-4 text-right font-heading font-bold text-primary-dark">Total</td>
                                <td class="pt-4 text-right font-heading font-bold text-lg text-primary-dark">{{ $quotation['amount'] }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-[#e3dfd3]/60">
                    @if ($quotation['status'] === 'Awaiting approval')
                        <button class="btn btn-primary inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-medium shadow-sm hover:shadow transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Approve quotation
                        </button>
                        <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-medium text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors">
                            Request revision
                        </button>
                    @endif
                    <button class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg font-medium text-sm text-[#5c6b5c] hover:text-primary-dark transition-colors sm:ml-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H8a2 2 0 01-2-2V5a2 2 0 012-2h6l4 4v11a2 2 0 01-2 2z"/></svg>
                        Download PDF
                    </button>
                </div>
            </div>

            {{-- Revision history --}}
            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6 lg:p-8">
                <div class="mb-6 pb-4 border-b border-[#e3dfd3]/60">
                    <h3 class="font-heading font-bold text-xl text-primary-dark">Revision history</h3>
                </div>
                <ol class="relative border-l-2 border-[#e3dfd3]/80 ml-3.5 space-y-6">
                    @foreach ($quotation['revisions'] as $rev)
                        <li class="ml-6">
                            <span class="absolute -left-[9px] w-4 h-4 rounded-full border-2 border-white {{ $loop->first ? 'bg-secondary' : 'bg-[#e3dfd3]' }}"></span>
                            <p class="text-sm font-semibold text-primary-dark">{{ $rev['title'] }}</p>
                            <p class="text-xs text-[#5c6b5c] mt-0.5">{{ $rev['note'] }}</p>
                            <p class="text-[11px] text-[#5c6b5c] mt-1">{{ $rev['date'] }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-8">
            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6">
                <h3 class="font-heading font-bold text-lg text-primary-dark mb-4">Summary</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-[#5c6b5c]">Reference</dt>
                        <dd class="font-mono font-medium text-primary-dark">{{ $quotation['ref'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-[#5c6b5c]">Project</dt>
                        <dd class="font-medium text-primary-dark text-right">{{ $quotation['project'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-[#5c6b5c]">Date sent</dt>
                        <dd class="font-medium text-primary-dark">{{ $quotation['date'] }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-[#5c6b5c]">Valid until</dt>
                        <dd class="font-medium text-primary-dark">{{ $quotation['validUntil'] }}</dd>
                    </div>
                    <div class="flex justify-between pt-3 border-t border-[#e3dfd3]/60">
                        <dt class="text-[#5c6b5c] font-medium">Total</dt>
                        <dd class="font-heading font-bold text-primary-dark">{{ $quotation['amount'] }}</dd>
                    </div>
                </dl>
            </div>

            <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 p-6">
                <h3 class="font-heading font-bold text-lg text-primary-dark mb-4">Prepared by</h3>
                <div class="flex items-center gap-3">
                    <span class="w-10 h-10 rounded-full bg-accent-light flex items-center justify-center font-heading font-semibold text-primary-dark text-sm">A</span>
                    <div>
                        <p class="text-sm font-semibold text-primary-dark">Amos Kiptoo</p>
                        <p class="text-xs text-[#5c6b5c]">Project Manager</p>
                    </div>
                </div>
                <a href="{{ route('messages.index') }}" class="mt-4 inline-flex w-full items-center justify-center gap-2 px-4 py-2.5 rounded-lg font-medium text-sm text-primary-dark border border-[#e3dfd3] hover:bg-slate-50 transition-colors">
                    Ask a question
                </a>
            </div>
        </div>
    </div>

@endsection
