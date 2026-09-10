@extends('layouts.app')

@section('title', 'Quotations, GreenScape Projects')
@section('page-title', 'Quotations')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-primary-dark tracking-tight">Quotations</h2>
            <p class="text-[#5c6b5c] text-sm mt-1">Review, approve, and download quotes for your projects.</p>
        </div>
    </div>

    <div class="card bg-white rounded-2xl shadow-sm border border-[#e3dfd3]/60 overflow-hidden">
        <div class="flex items-center justify-between px-6 lg:px-8 py-5 border-b border-[#e3dfd3]/60">
            <h3 class="font-heading font-bold text-xl text-primary-dark">All quotations</h3>
            <span class="text-xs font-medium text-[#5c6b5c] bg-slate-100 px-3 py-1 rounded-full">3 total</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead>
                    <tr class="text-xs font-semibold uppercase tracking-wider text-[#5c6b5c] border-b border-[#e3dfd3]/80 bg-slate-50/50">
                        <th class="px-6 lg:px-8 py-3">Reference</th>
                        <th class="py-3">Project</th>
                        <th class="py-3 text-center">Date</th>
                        <th class="py-3 text-right">Amount</th>
                        <th class="py-3 text-right">Status</th>
                        <th class="py-3 text-right px-6 lg:px-8"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#e3dfd3]/50">
                    @foreach ([
                        ['ref' => 'QT-2026-014', 'project' => 'Ruiru Family Residence', 'date' => 'Aug 12, 2026', 'amount' => 'KSh 1,800,000', 'status' => 'Approved', 'statusClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200'],
                        ['ref' => 'QT-2026-021', 'project' => 'Karen Boutique Hotel', 'date' => 'Sep 3, 2026', 'amount' => 'KSh 4,250,000', 'status' => 'Awaiting approval', 'statusClass' => 'bg-amber-100 text-amber-800 border-amber-200'],
                        ['ref' => 'QT-2026-007', 'project' => 'Westlands Office Courtyard', 'date' => 'Jun 2, 2026', 'amount' => 'KSh 620,000', 'status' => 'Paid', 'statusClass' => 'bg-emerald-100 text-emerald-800 border-emerald-200'],
                    ] as $quote)
                        <tr class="hover:bg-slate-50/80 transition-colors cursor-pointer" onclick="window.location='{{ route('quotations.show', $quote['ref']) }}'">
                            <td class="px-6 lg:px-8 py-4 font-mono text-xs font-semibold text-primary-dark">{{ $quote['ref'] }}</td>
                            <td class="py-4 font-medium text-primary-dark">{{ $quote['project'] }}</td>
                            <td class="py-4 text-center text-slate-600">{{ $quote['date'] }}</td>
                            <td class="py-4 text-right font-semibold text-primary-dark">{{ $quote['amount'] }}</td>
                            <td class="py-4 text-right">
                                <span class="pill text-xs px-2.5 py-1 rounded-full border font-medium {{ $quote['statusClass'] }}">
                                    {{ $quote['status'] }}
                                </span>
                            </td>
                            <td class="py-4 text-right px-6 lg:px-8">
                                <a href="{{ route('quotations.show', $quote['ref']) }}" class="text-xs font-semibold text-primary hover:text-accent transition-colors">
                                    View →
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
