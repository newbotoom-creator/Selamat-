@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-4 space-y-10">
    
    <div class="bg-white p-6 md:p-10 rounded-[35px] shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Laporan Statistik</h2>
                
                <p class="text-gray-700">Analisis frekuensi penggunaan MathEngine.</p>
            </div>
            @guest
            <a href="/login" class="hidden md:flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-100 active:scale-95">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                Admin
            </a>
            @endguest
        </div>

        <div class="h-[450px]">
            <canvas id="reportChart"></canvas>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // PERBAIKAN: Ubah 'myChart' menjadi 'reportChart' agar sesuai dengan ID canvas di atas
    const ctx = document.getElementById('reportChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Perhitungan',
                data: {!! json_encode($chartData) !!}, // Memastikan data terkirim dari controller
                backgroundColor: '#2563eb',
                borderRadius: 10,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1 } 
                }
            }
        }
    });
</script>
<form id="bulk-delete-form" action="{{ route('admin.bulk_destroy') }}" method="POST">
    @csrf
    @method('DELETE')
    
    <div class="max-h-[500px] overflow-y-auto pr-2 custom-scrollbar relative">
        <table class="w-full text-left border-collapse" id="activity-table">
            <thead class="sticky top-0 bg-white z-10">
                <tr class="border-b text-gray-400 text-xs uppercase tracking-wider">
                    <th class="py-4 px-2">Waktu</th>
                    <th class="py-4 px-2">Nama</th>
                    <th class="py-4 px-2">Perhitungan</th>
                    <th class="py-4 px-2">Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $data)
                <tr class="border-b hover:bg-blue-50 transition cursor-pointer row-item" data-id="{{ $data->id }}">
                    <td class="py-4 px-2 text-sm text-gray-500">
                        <input type="checkbox" name="ids[]" value="{{ $data->id }}" class="hidden row-checkbox">
                        {{ $data->created_at->format('H:i d/m/y') }}
                    </td>
                    <td class="py-4 px-2 text-sm font-bold text-blue-600">{{ $data->user_name }}</td>
                    <td class="py-4 px-2 text-sm italic text-gray-600">{{ $data->formula }}</td>
                    <td class="py-4 px-2 text-sm font-black">{{ $data->result }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

<div id="context-menu" class="hidden fixed bg-white shadow-xl rounded-lg border border-gray-200 py-2 z-50 w-48">
    <button onclick="deleteSelected()" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
        Hapus (<span id="selected-count">0</span>)
    </button>
    <button onclick="clearSelection()" class="w-full text-left px-4 py-2 text-sm text-gray-600 hover:bg-gray-100">
        Batalkan Pilihan
    </button>
</div>
<script>
    const table = document.getElementById('activity-table');
    const contextMenu = document.getElementById('context-menu');
    const selectedCountSpan = document.getElementById('selected-count');

    // Mencegah menu klik kanan bawaan browser di area tabel
    table.addEventListener('contextmenu', e => {
        e.preventDefault();
        const items = document.querySelectorAll('.row-item.bg-blue-100').length;
        
        if (items > 0) {
            selectedCountSpan.innerText = items;
            contextMenu.style.top = `${e.clientY}px`;
            contextMenu.style.left = `${e.clientX}px`;
            contextMenu.classList.remove('hidden');
        }
    });

    // Menangani klik baris untuk memilih (Multi-select)
    document.querySelectorAll('.row-item').forEach(row => {
        row.addEventListener('click', (e) => {
            row.classList.toggle('bg-blue-100');
            const checkbox = row.querySelector('.row-checkbox');
            checkbox.checked = !checkbox.checked;
            contextMenu.classList.add('hidden');
        });
    });

    // Sembunyikan menu jika klik di tempat lain
    document.addEventListener('click', () => contextMenu.classList.add('hidden'));

    function deleteSelected() {
        if(confirm('Hapus semua data yang dipilih?')) {
            document.getElementById('bulk-delete-form').submit();
        }
    }

    function clearSelection() {
        document.querySelectorAll('.row-item').forEach(row => {
            row.classList.remove('bg-blue-100');
            row.querySelector('.row-checkbox').checked = false;
        });
    }
</script>

<style>
    /* Styling scrollbar agar lebih minimalis */
    .custom-scrollbar::-webkit-scrollbar { width: 5px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
</style>
@endsection