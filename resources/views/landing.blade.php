@extends('layouts.guest')

@section('title', 'GreenScape Projects — Landscape Design & Project Management')

@section('content')

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-gradient-to-b from-[#eef3e6] to-base">
        <div class="max-w-6xl mx-auto px-6 pt-20 pb-24 grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-block bg-secondary/20 text-primary-dark text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    Landscape design, built for transparency
                </span>
                <h1 class="font-heading text-4xl md:text-5xl font-bold text-primary-dark leading-tight mb-5">
                    From first sketch to<br class="hidden md:block"> the last leaf planted.
                </h1>
                <p class="text-[#5c6b5c] text-lg mb-8 max-w-md">
                    GreenScape Projects manages every stage of your landscaping project —
                    design, quotation, planting, and maintenance — with live updates
                    you can follow from your phone.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('register') }}" class="btn btn-primary">Start your project</a>
                    <a href="#process" class="btn btn-outline">See how it works</a>
                </div>
                <div class="flex items-center gap-6 mt-10 text-sm text-[#5c6b5c]">
                    <div><span class="block text-2xl font-heading font-bold text-primary-dark">240+</span>Projects delivered</div>
                    <div><span class="block text-2xl font-heading font-bold text-primary-dark">98%</span>On-time completion</div>
                    <div><span class="block text-2xl font-heading font-bold text-primary-dark">4.9/5</span>Client rating</div>
                </div>
            </div>

            <div class="relative">
                <div class="card p-3 rotate-2">
                    <div class="aspect-[4/3] rounded-[14px] bg-gradient-to-br from-primary-light to-secondary/60 flex items-center justify-center text-white/90 font-heading text-sm">
                        Project render preview
                    </div>
                </div>
                <div class="card p-3 -rotate-3 absolute -bottom-8 -left-8 w-40 hidden md:block">
                    <div class="aspect-square rounded-[10px] bg-accent-light flex items-center justify-center text-primary-dark text-xs font-heading">
                        Site progress
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SERVICES --}}
    <section id="services" class="max-w-6xl mx-auto px-6 py-20">
        <div class="max-w-2xl mb-12">
            <h2 class="font-heading text-3xl font-bold mb-3">What we do</h2>
            <p class="text-[#5c6b5c]">
                One team, one platform — covering every stage of residential and
                commercial landscape delivery.
            </p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ([
                ['title' => 'Landscape Design', 'copy' => 'Concept renders, planting plans, and mood-board driven design tailored to your style.', 'icon' => '🌿'],
                ['title' => 'Quotation & Materials', 'copy' => 'Transparent, itemised quotes covering plants, hardscaping, irrigation, and labour.', 'icon' => '📋'],
                ['title' => 'Site Implementation', 'copy' => 'Daily progress photos and plant-by-plant tracking from ground-breaking to hand-over.', 'icon' => '🏗️'],
                ['title' => 'Plant & Material Tracking', 'copy' => 'Every quoted tree, shrub, and bag of mulch checked off as it goes into the ground.', 'icon' => '🌳'],
                ['title' => 'Client Portal', 'copy' => 'Compare renders against real photos, approve designs, and message your project manager.', 'icon' => '📱'],
                ['title' => 'Maintenance Plans', 'copy' => 'Ongoing care schedules to keep your landscape healthy long after hand-over.', 'icon' => '✂️'],
            ] as $service)
                <div class="card p-6 hover:shadow-md transition-shadow">
                    <div class="w-11 h-11 rounded-lg bg-secondary/15 flex items-center justify-center text-xl mb-4">
                        {{ $service['icon'] }}
                    </div>
                    <h3 class="font-heading font-semibold text-lg mb-2">{{ $service['title'] }}</h3>
                    <p class="text-sm text-[#5c6b5c]">{{ $service['copy'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- PROCESS --}}
    <section id="process" class="bg-primary-dark/[0.03] py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="max-w-2xl mb-12">
                <h2 class="font-heading text-3xl font-bold mb-3">How a project moves forward</h2>
                <p class="text-[#5c6b5c]">A guided pipeline so nothing quoted is ever forgotten on site.</p>
            </div>
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ([
                    ['step' => '01', 'title' => 'Inquiry & Onboarding', 'copy' => 'Tell us your style, budget, and property details.'],
                    ['step' => '02', 'title' => 'Design & Quotation', 'copy' => 'Review renders and an itemised quote, then approve.'],
                    ['step' => '03', 'title' => 'Implementation', 'copy' => 'Follow live site photos as plants and materials go in.'],
                    ['step' => '04', 'title' => 'Hand-over & Care', 'copy' => 'Final walkthrough, documentation, and maintenance plan.'],
                ] as $item)
                    <div class="card p-6">
                        <span class="font-heading text-2xl font-bold text-secondary">{{ $item['step'] }}</span>
                        <h3 class="font-heading font-semibold mt-3 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-sm text-[#5c6b5c]">{{ $item['copy'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ABOUT --}}
    <section id="about" class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <div class="card p-3">
            <div class="aspect-[4/3] rounded-[14px] bg-gradient-to-br from-accent-light to-secondary/40"></div>
        </div>
        <div>
            <h2 class="font-heading text-3xl font-bold mb-4">Built by people who plant, not just people who code</h2>
            <p class="text-[#5c6b5c] mb-4">
                GreenScape Projects grew out of years spent running landscaping
                crews the old way — spreadsheets, missed deliveries, and clients
                left wondering what was happening on site. We built the platform
                we wished we'd had.
            </p>
            <p class="text-[#5c6b5c] mb-6">
                Today it's the single source of truth for our designers, site
                supervisors, and clients — from the first inspiration board to
                the last plant in the ground.
            </p>
            <a href="{{ route('register') }}" class="btn btn-secondary">Join as a client</a>
        </div>
    </section>

    {{-- CONTACT / CTA --}}
    <section id="contact" class="max-w-6xl mx-auto px-6 pb-20">
        <div class="card bg-primary text-white p-10 md:p-14 text-center rounded-[24px]">
            <h2 class="font-heading text-3xl font-bold mb-3 text-white">Ready to start your landscape project?</h2>
            <p class="text-white/80 max-w-xl mx-auto mb-8">
                Create your client account to submit a project request, share your
                inspiration, and track every step from your dashboard.
            </p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="{{ route('register') }}" class="btn bg-white text-primary-dark hover:bg-white/90">Create an account</a>
                <a href="mailto:hello@greenscapeprojects.com" class="btn border border-white/40 text-white hover:bg-white/10">Email us</a>
            </div>
        </div>
    </section>

@endsection
