@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto w-full">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-50 rounded-[30px] mb-6 shadow-sm">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-black text-gray-900 tracking-tight">Admin <span class="text-blue-600">Access</span></h2>
            <p class="mt-2 text-sm text-gray-500 font-medium">Silakan masuk untuk mengelola statistik dan laporan.</p>
        </div>

        <div class="bg-white p-8 md:p-10 rounded-[40px] shadow-2xl shadow-blue-100/50 border border-gray-50">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-1">Email Address</label>
                    <input type="email" name="email" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all placeholder:text-gray-300" 
                        placeholder="admin@mathengine.com" required autofocus>
                    @error('email')
                        <p class="mt-2 text-xs text-red-500 font-bold ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-3 ml-1">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-blue-600 hover:underline uppercase tracking-wider">Lupa?</a>
                        @endif
                    </div>
                    <input type="password" name="password" 
                        class="w-full p-4 bg-gray-50 border-none rounded-2xl text-sm font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all placeholder:text-gray-300" 
                        placeholder="••••••••" required>
                </div>

                <div class="flex items-center ml-1">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-3 text-xs font-bold text-gray-500">Ingat perangkat ini</label>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-gray-900 hover:bg-black text-white text-sm font-black rounded-2xl shadow-xl transition-all transform active:scale-[0.98] flex items-center justify-center gap-3">
                    Masuk ke Dashboard
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>
        </div>

        <p class="mt-8 text-center">
            <a href="/" class="text-xs font-bold text-gray-400 hover:text-blue-600 transition flex items-center justify-center gap-2">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Kalkulator
            </a>
        </p>
    </div>
</div>
@endsection