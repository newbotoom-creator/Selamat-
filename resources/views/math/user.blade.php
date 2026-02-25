@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-20">
    <div class="bg-white p-10 rounded-[35px] shadow-xl text-center">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Selamat Datang di MathEngine</h2>
        <p class="mb-8 text-gray-500 text-lg">Silakan masukkan nama Anda untuk memulai.</p>
        
        <form action="{{ route('math.set_user') }}" method="POST">
            @csrf
            <input type="text" name="user_name" required placeholder="Nama Lengkap" 
                   class="w-full p-5 border border-gray-200 rounded-2xl mb-6 text-center text-xl focus:ring-2 focus:ring-blue-500 outline-none">
            
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-10 py-5 rounded-2xl font-bold text-xl shadow-lg transition-all">
                Mulai Berhitung
            </button>
        </form>
    </div>
</div>
@endsection