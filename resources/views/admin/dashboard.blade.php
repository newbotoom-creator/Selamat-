@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 space-y-8">
    <div class="flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-black text-gray-900 tracking-tight">Dashboard</h2>
            <p class="text-gray-500 font-medium">Ringkasan performa sistem saat ini.</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="px-6 py-2 bg-red-50 text-red-600 rounded-2xl font-bold text-sm hover:bg-red-100 transition">logout</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Total Perhitungan</p>
            <h3 class="text-3xl font-black text-blue-600">{{ number_format($totalCalculations) }}</h3>
        </div>
        <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">User Aktif</p>
            <h3 class="text-3xl font-black text-gray-900">{{ $activeUsers }}</h3>
        </div>
        <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Status Server</p>
            <h3 class="text-3xl font-black text-green-500">Online</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
            <h4 class="font-bold text-gray-800 mb-6">Tren Penggunaan</h4>
            <div class="h-[300px]">
                <canvas id="reportChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-[35px] shadow-sm border border-gray-100">
            <h4 class="font-bold text-gray-800 mb-6">Aktivitas Terakhir</h4>
            <div class="space-y-4">
                @foreach($recentHistories as $log)
                <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-2xl transition">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                    <div>
                        <p class="text-sm font-bold text-gray-800">{{ $log->user_name }}</p>
                        <p class="text-xs text-gray-500">{{ $log->formula }} = {{ $log->result }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('reportChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                data: {!! json_encode($chartData) !!},
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 4,
                pointRadius: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: { y: { display: false }, x: { grid: { display: false } } }
        }
    });
</script>
@endsection