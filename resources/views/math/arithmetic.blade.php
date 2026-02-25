@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto pt-16 pb-10 px-4">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">MathEngine <span class="text-blue-600">Pro</span></h1>
        <p class="text-gray-500 text-lg">Masukkan angka untuk hasil instan, klik untuk penjelasan detail.</p>
    </div>

    <div class="bg-white p-2 rounded-[40px] shadow-2xl shadow-blue-100 border border-gray-50 overflow-hidden">
        <form action="{{ route('math.arithmetic') }}" method="POST" class="p-8">
            @csrf
            <div class="flex flex-col md:flex-row items-center gap-4 bg-gray-50 p-6 rounded-[32px] border border-gray-100">
                <input type="number" name="num1" step="any" 
                    class="w-full md:flex-1 p-4 bg-white rounded-2xl text-3xl font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all text-center shadow-sm" 
                    placeholder="0" required>
                
                <div class="relative group">
                    <select name="operation" class="w-24 p-4 bg-blue-600 text-white rounded-2xl text-2xl font-black cursor-pointer hover:bg-blue-700 transition appearance-none text-center shadow-lg shadow-blue-200">
                        <option value="add">+</option>
                        <option value="subtract">-</option>
                        <option value="multiply">×</option>
                        <option value="divide">÷</option>
                        <option value="power">^</option>
                        <option value="sqrt">√</option>
                    </select>
                </div>

                <input type="number" name="num2" step="any" 
                    class="w-full md:flex-1 p-4 bg-white rounded-2xl text-3xl font-bold focus:ring-4 focus:ring-blue-100 outline-none transition-all text-center shadow-sm" 
                    placeholder="0" required>
                
                <button type="submit" class="w-full md:w-auto px-8 py-5 bg-gray-900 hover:bg-black text-white rounded-2xl text-xl font-bold transition-all shadow-xl flex items-center justify-center gap-3 active:scale-95">
                    Hitung
                </button>
            </div>
        </form>
    </div>

    <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 opacity-60 grayscale hover:grayscale-0 transition-all">
        @isset($histories)
            @foreach($histories->take(4) as $history)
                <div class="p-4 bg-white rounded-2xl border border-gray-100 text-center">
                    <p class="text-xs font-bold text-gray-400">{{ $history->formula }}</p>
                    <p class="text-lg font-black text-gray-800">= {{ $history->result }}</p>
                </div>
            @endforeach
        @endisset
    </div>
</div>
@endsection