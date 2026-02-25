@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-blue-600 p-8 text-white text-center">
            <h2 class="text-5xl font-black">{{ number_format($result, 0, ',', '.') }}</h2>
            
            <div class="mt-4 inline-block px-6 py-2 bg-white/20 rounded-full font-bold">
                Status: {{ $status }}
            </div>
        </div>
        
        <div class="p-6 text-center text-gray-600 border-b border-gray-50">
            <p class="text-lg">
                Hasil perhitungan dari <strong>{!! $explanation['rumus_visual'] !!}</strong> adalah 
                <span class="text-blue-600 font-bold">{{ number_format($result, 0, ',', '.') }}</span>. 
                Karena ini {{ $result > 112665 ? 'lebih dari' : 'kurang dari' }} 112.665, maka dinyatakan <strong>{{ $status }}</strong>.
            </p>
        </div>

        <div class="p-12">
            <h3 class="text-2xl font-bold text-gray-900 mb-6 italic">Langkah-langkah Matematis:</h3>
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-8 bg-blue-50 rounded-3xl border border-blue-100 flex flex-col justify-center items-center">
                    <p class="text-blue-600 font-bold mb-4 uppercase tracking-widest text-sm">Persamaan:</p>
                    <div class="text-3xl">
                        {!! $explanation['rumus_visual'] !!}
                    </div>
                </div>

                <div class="p-8 bg-gray-50 rounded-3xl border border-gray-100">
                    <div class="prose prose-blue text-lg leading-relaxed text-gray-700">
                        {!! $explanation['langkah'] !!}
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('math.index') }}" class="px-8 py-3 bg-gray-800 text-white rounded-xl font-bold hover:bg-black transition">
                    Kembali ke Kalkulator
                </a>
            </div>
        </div>
    </div>
</div>
@endsection