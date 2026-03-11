@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16 space-y-20 animate-in fade-in slide-in-from-bottom-8 duration-700">
    
    <header class="space-y-4">
        <h1 class="text-7xl font-black text-slate-900 tracking-tighter">
            Central <span class="brand-gradient-text">Hub</span>
        </h1>
        <p class="text-slate-500 text-2xl font-medium max-w-2xl leading-relaxed tracking-tight">
            Welcome, <span class="text-primary-600 font-black">{{ Auth::user()->name }}</span>. Manage your geotechnical datasets and generate professional reports with precision.
        </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Feature 1: CSV Management -->
        <div class="card-premium p-12 group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary-50 rounded-full blur-3xl group-hover:bg-primary-100 transition-all opacity-20"></div>
            <div class="space-y-10 relative z-10">
                <div class="w-16 h-16 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-all duration-500 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div class="space-y-4">
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Upload & Make CSV</h2>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed">
                        Process raw geotechnical datasets and normalize them into standardized CSV formats for analysis.
                    </p>
                </div>
                <div class="pt-4">
                    <a href="#" class="btn-primary inline-flex">
                        Open CSV Studio
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Feature 2: PDF Generation -->
        <div class="card-premium p-12 group relative overflow-hidden border-primary-100/50">
            <div class="absolute top-0 right-0 w-32 h-32 bg-accent-50 rounded-full blur-3xl group-hover:bg-accent-100 transition-all opacity-40"></div>
            <div class="space-y-10 relative z-10">
                <div class="w-16 h-16 bg-accent-50 rounded-2xl flex items-center justify-center text-accent-600 group-hover:bg-accent-600 group-hover:text-white transition-all duration-500 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="space-y-4">
                    <h2 class="text-4xl font-black text-slate-900 tracking-tight">Generate PDF Report</h2>
                    <p class="text-slate-500 font-medium text-lg leading-relaxed">
                        Compose comprehensive geotechnical reports with dynamic tables, narrative content, and auto-generated graphs.
                    </p>
                </div>
                <div class="pt-4">
                    <a href="{{ route('report.upload') }}" class="btn-primary inline-flex">
                        Launch Report Studio
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
