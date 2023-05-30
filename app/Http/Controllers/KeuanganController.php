<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari database berdasarkan range tanggal
        $data = Guest::all();
        $data1 = Guest::sum('total');
        // Tampilkan data ke dalam view
        return view('backend.receptionist.cashopame', compact('data', 'data1'));
    }

    public function uang(Request $request)
    {

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        // $specific_date = $request->input('specific_date');

        // Mengambil data transaksi berdasarkan rentang tanggal dan tanggal tertentu
        if ($start_date == $end_date) {
            $data = Guest::whereDate('created_at', $start_date)->get();
            $data1 = $data->sum('total');
        } else {
            $data = Guest::whereBetween('created_at', [$start_date, $end_date])->get();
            $data1 = $data->sum('total');
        }

        return view('backend.receptionist.cashopame', compact('data', 'start_date', 'end_date', 'data1'));
    }
    public function uang1(Request $request)
    {

        // Mendapatkan input jam dari form
        $start_time = request()->input('start_time');
        $end_time = request()->input('end_time');

        // Query untuk mengambil data transaksi pada rentang waktu tertentu
        $data = Guest::whereBetween(DB::raw('TIME(created_at)'), [$start_time, $end_time])
            ->get();

        // Menghitung total income
        $data1 = $data->sum('total');

        return view('backend.receptionist.cashopame', compact('data', 'data1'));
    }

    public function pdf(Request $request)
    {
        // Mengambil parameter start_date dan end_date dari query string
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Query untuk mengambil data transaksi berdasarkan rentang tanggal
        $data = Guest::whereBetween('created_at', [$start_date, $end_date])->get();

        // Menghitung total jumlah transaksi
        $total = $data->sum('jumlah');

        // Mengirim data ke view
        // $pdf = PDF::loadView('keuangan.pdf', compact('data', 'start_date', 'end_date', 'total'));
        $pdf = \Barryvdh\DomPDF\Facade\PDF::loadView('backend.receptionist.pdf', compact('data', 'start_date', 'end_date', 'total'));
        return $pdf->download('laporan-keuangan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Keuangan $keuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keuangan $keuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Keuangan $keuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keuangan $keuangan)
    {
        //
    }
}
