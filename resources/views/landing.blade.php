@extends('layouts.landing')

@section('title', 'SIMS - The future of business management')

@section('content')
<!-- Hero Section -->
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center">
            <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-slate-900 mb-6 font-display">
                The future of <span class="gradient-text">business management</span> is here.
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed text-balance">
                SIMS is the comprehensive solution for SMEs and freelancers looking to take their inventory and billing to the next level.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="http://localhost:5173" class="px-8 py-4 rounded-full bg-blue-600 text-white font-bold hover:bg-blue-700 transition-all shadow-xl shadow-blue-200 active:scale-95 text-lg">
                    Start now for free
                </a>
                <a href="#features" class="px-8 py-4 rounded-full bg-white text-blue-600 border border-blue-100 font-bold hover:bg-slate-50 transition-all active:scale-95 text-lg">
                    View features
                </a>
            </div>
        </div>

        <div class="mt-20 relative mx-auto max-w-5xl">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/20 animate-float">
                <img src="{{ asset('images/hero_dashboard.png') }}" alt="SIMS Dashboard" class="w-full h-auto">
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-cyan-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-pulse"></div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-24 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-4 font-display">Designed for your efficiency</h2>
            <p class="text-slate-600 max-w-xl mx-auto">All the tools you need to manage your business without complications.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-100 card-hover">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 font-display">Multi-company Management</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Control multiple delegations or companies from a single centralized panel, sharing administration resources.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-100 card-hover">
                <div class="w-12 h-12 bg-cyan-50 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 font-display">Intelligent Inventory</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Automated stock tracking with personalized alerts and advanced supplier management.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-3xl border border-slate-100 card-hover">
                <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-3 font-display">Data Analysis</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Interactive charts and detailed reports to make decisions based on real data.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section id="stats" class="py-24 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-blue-600 rounded-[3rem] p-12 md:p-20 relative overflow-hidden flex flex-col md:flex-row items-center gap-12">
            <div class="relative z-10 flex-1">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 font-display">Created for leaders seeking the best control.</h2>
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <div class="text-4xl font-bold text-white mb-1 font-display">+1K</div>
                        <div class="text-blue-100 text-sm">Active companies</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-white mb-1 font-display">99%</div>
                        <div class="text-blue-100 text-sm">Satisfaction</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-white mb-1 font-display">24/7</div>
                        <div class="text-blue-100 text-sm">Technical support</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-white mb-1 font-display">Instant</div>
                        <div class="text-blue-100 text-sm">Synchronization</div>
                    </div>
                </div>
            </div>
            <div class="relative z-10 flex-1">
                <img src="{{ asset('images/inventory_feature.png') }}" alt="Inventory Analytics" class="w-full max-w-sm mx-auto animate-float">
            </div>
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 blur-2xl"></div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-24">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-bold text-slate-900 mb-8 font-display">Ready to transform your business?</h2>
        <p class="text-slate-600 mb-10 text-lg">Join hundreds of companies that already use SIMS to optimize their processes.</p>
        <a href="http://localhost:5173" class="inline-flex items-center px-10 py-5 rounded-full bg-slate-900 text-white font-bold hover:bg-slate-800 transition-all shadow-2xl active:scale-95 text-lg">
            Register NOW
            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
        </a>
    </div>
</section>
@endsection
