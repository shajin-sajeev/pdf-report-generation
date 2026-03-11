@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-[#f8fafc]">
    <!-- Ornamental Elements -->
    <div class="absolute -top-[10%] -right-[10%] w-[50%] h-[50%] bg-gradient-to-br from-primary-500/20 to-accent-500/10 rounded-full blur-[120px] animate-float"></div>
    <div class="absolute -bottom-[10%] -left-[10%] w-[50%] h-[50%] bg-gradient-to-tr from-accent-500/10 to-primary-500/20 rounded-full blur-[120px] animate-float" style="animation-delay: -3s"></div>

    <div class="w-full max-w-xl px-8 relative z-10 py-20">
        <div class="card-premium p-16 space-y-12">
            <div class="text-center space-y-4">
                <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-accent-500 rounded-[2.5rem] mx-auto flex items-center justify-center shadow-2xl shadow-primary-500/20 transform -rotate-6">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="space-y-2">
                    <h1 class="text-5xl font-black text-slate-900 tracking-tighter">Welcome Back</h1>
                    <p class="text-slate-400 font-medium text-lg italic">Precision Geotechnical Report Management</p>
                </div>
            </div>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] pl-1">Authorized Email</label>
                        <input type="email" name="email" required class="input-premium" placeholder="admin@gmail.com">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-primary-600 uppercase tracking-[0.2em] pl-1">Security Key</label>
                        <input type="password" name="password" required class="input-premium" placeholder="••••••••">
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 text-red-500 p-4 rounded-2xl text-xs font-black uppercase tracking-widest text-center border border-red-100">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn-primary w-full py-6 text-xl shadow-xl shadow-primary-500/20">
                    Gain Access
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
        
        <p class="text-center mt-12 text-slate-400 text-xs font-bold uppercase tracking-widest">
            &copy; {{ date('Y') }} Precision Engineering Services
        </p>
    </div>
</div>
@endsection
