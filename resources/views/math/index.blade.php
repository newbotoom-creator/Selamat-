@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto pt-20 pb-10 px-4">
    <div class="text-center mb-12">
        <h1 class="text-5xl font-black text-gray-900 mb-4 tracking-tight">MathEngine <span class="text-blue-600">Pro</span></h1>
        <p class="text-xl text-gray-500 font-light">Kalkulator cerdas dengan penjelasan langkah demi langkah.</p>
    </div>

    <div class="bg-white p-6 rounded-[45px] shadow-2xl shadow-blue-100/50 border border-gray-100">
        <form action="{{ route('math.arithmetic') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row items-stretch gap-3">
                
                <div class="flex flex-1 items-center gap-3 bg-gray-50 p-3 rounded-[32px] border border-gray-100">
                    <input type="number" name="num1" step="any" 
                        class="w-full bg-white p-5 rounded-2xl text-2xl font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all text-center shadow-sm" 
                        placeholder="0" required>
                    
                    <div class="relative shrink-0">
                        <select name="operation" 
                            class="w-14 h-14 bg-blue-600 text-white rounded-2xl text-2xl font-bold cursor-pointer hover:bg-blue-700 transition appearance-none text-center shadow-lg shadow-blue-200 outline-none">
                            <option value="add">+</option>
                            <option value="subtract">-</option>
                            <option value="multiply">×</option>
                            <option value="divide">÷</option>
                            <option value="power">^</option>
                            <option value="sqrt">√</option>
                        </select>
                    </div>

                    <input type="number" name="num2" step="any" 
                        class="w-full bg-white p-5 rounded-2xl text-2xl font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all text-center shadow-sm" 
                        placeholder="0" required>
                </div>

                <button type="submit" 
                    class="h-14 px-8 bg-gray-900 hover:bg-black text-white text-sm font-extrabold rounded-2xl shadow-lg transition-all transform active:scale-95 flex items-center justify-center gap-2 shrink-0 self-center">
                    <span>Hitung</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection