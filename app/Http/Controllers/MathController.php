<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MathService;
use App\Models\CalculationHistory;

class MathController extends Controller
{
    protected $mathService;

    public function __construct(MathService $mathService)
    {
        $this->mathService = $mathService;
    }

    /*
    |--------------------------------------------------------------------------
    | HALAMAN KALKULATOR
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        if (!session()->has('user_name')) {
            return redirect()->route('math.user');
        }

          $histories = CalculationHistory::latest()->take(4)->get();
        return view('math.index', compact('histories'));
    }

    /*
    |--------------------------------------------------------------------------
    | FORM INPUT NAMA USER
    |--------------------------------------------------------------------------
    */
    public function showUserForm()
    {
        // Jika sudah isi nama → langsung ke kalkulator
        if (session()->has('user_name')) {
            return redirect()->route('math.index');
        }

        return view('math.user');
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN NAMA USER KE SESSION
    |--------------------------------------------------------------------------
    */
    public function setUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:2|max:50'
        ]);

        session([
            'user_name' => $request->user_name
        ]);

        return redirect()->route('math.index');
    }

    /*
    |--------------------------------------------------------------------------
    | HITUNG ARITMATIKA
    |--------------------------------------------------------------------------
    */
    public function arithmetic(Request $request)
{
    // 1. Validasi input
    $request->validate([
        'num1' => 'required|numeric',
        'num2' => 'required|numeric',
        'operation' => 'required'
    ]);

    // 2. Mapping simbol (seperti yang kamu minta sebelumnya)
    $symbols = [
        'add' => '+', 'subtract' => '-', 'multiply' => '×', 
        'divide' => '÷', 'power' => '^', 'sqrt' => '√'
    ];
    $operationSymbol = $symbols[$request->operation] ?? $request->operation;

    // 3. HITUNG HASILNYA DULU (PENTING!)
    // Pindahkan baris ini ke atas sebelum CalculationHistory::create
    $result = $this->mathService->calculate(
        $request->num1,
        $request->num2,
        $request->operation
    );

    // 4. Susun format formula
    $formula = ($request->operation == 'sqrt') 
        ? $operationSymbol . ' ' . $request->num1 
        : $request->num1 . ' ' . $operationSymbol . ' ' . $request->num2;

    // 5. BARU SIMPAN KE DATABASE
    // Sekarang $result sudah ada isinya dan tidak akan error lagi
    CalculationHistory::create([
        'user_name' => session('user_name', 'Guest'),
        'formula'   => $formula,
        'result'    => $result, 
        'type'      => 'Aritmatika'
    ]);

    // ... sisa kode view return ...

        $explanation = $this->mathService->getExplanation(
            $request->num1,
            $request->num2,
            $request->operation,
            $result
        );

        $status = ($result > 112665) ? "Sehat" : "Normal/Perlu Cek";

        $histories = CalculationHistory::latest()->take(5)->get();

        return view('math.arithmetic_detail', compact(
            'result',
            'status',
            'explanation',
            'histories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */
    public function report()
{
    // Inisialisasi 12 bulan dengan nilai 0
    $monthlyData = array_fill(1, 12, 0);

    // Gunakan fungsi MONTH() dan YEAR() untuk MySQL
    $counts = CalculationHistory::selectRaw("
            MONTH(created_at) as month, 
            count(*) as total
        ")
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->pluck('total', 'month');

    foreach ($counts as $month => $total) {
        $monthlyData[(int)$month] = $total;
    }

    $chartData = array_values($monthlyData);
    $histories = CalculationHistory::latest()->get();

    return view('math.report', compact('histories', 'chartData'));
}

   public function calculate(Request $request)
{
    $expression = $request->input('expression');

    // Validasi: Hanya izinkan angka, +, -, *, /, ., dan kurung
    if (!preg_match('/^[0-9+\-*\/().\s]+$/', $expression)) {
        return response()->json(['error' => 'Input tidak valid'], 400);
    }

    try {
        $result = eval("return $expression;");
        
        CalculationHistory::create([
            'user_name' => session('user_name'),
            'formula' => $expression,
            'result' => $result,
            'type' => 'Kalkulator'
        ]);

        return response()->json(['result' => $result]);
    } catch (\Throwable $e) {
        return response()->json(['error' => 'Perhitungan error'], 400);
    }
}

    /*
    |--------------------------------------------------------------------------
    | HAPUS HISTORY
    |--------------------------------------------------------------------------
    */
    public function clearHistory($type)
    {
        CalculationHistory::where('type', $type)->delete();
        return redirect()->route('math.report')->with('success', 'History berhasil dihapus!');
    }

//admin dashboard/*
public function dashboard()
{
    // Mengambil total perhitungan
    $totalCalculations = CalculationHistory::count();
    
    // Menghitung user unik berdasarkan nama
    $activeUsers = CalculationHistory::distinct('user_name')->count();
    
    // Riwayat terbaru untuk feed
    $recentHistories = CalculationHistory::latest()->take(5)->get();

    // Data grafik (MySQL)
    $monthlyData = array_fill(1, 12, 0);
    $counts = CalculationHistory::selectRaw("MONTH(created_at) as month, count(*) as total")
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->pluck('total', 'month');

    foreach ($counts as $month => $total) {
        $monthlyData[(int)$month] = $total;
    }

    return view('admin.dashboard', [
        'totalCalculations' => $totalCalculations,
        'activeUsers' => $activeUsers,
        'recentHistories' => $recentHistories,
        'chartData' => array_values($monthlyData)
    ]);
}

public function destroyHistory($id)
{
    $history = CalculationHistory::findOrFail($id);
    $history->delete();

    return back()->with('success', 'Data aktivitas berhasil dihapus.');
}

public function bulkDestroy(Request $request)
{
    $ids = $request->ids;
    if ($ids) {
        CalculationHistory::whereIn('id', $ids)->delete();
        return back()->with('success', count($ids) . ' data berhasil dihapus.');
    }
    return back();
}

}