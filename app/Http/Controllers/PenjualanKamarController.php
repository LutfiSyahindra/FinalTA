<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\PenjualanKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data dari database berdasarkan range tanggal
        $data = Guest::select('room_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('room_id')
            ->get();
        // Tampilkan data ke dalam view
        return view('backend.receptionist.penjualan', compact('data'));
    }

    public function filter(Request $request)
    {

        // Ambil nilai range tanggal dari form
        $start_date = request('start_date');
        $end_date = request('end_date');

        // Lakukan validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        // Ambil data dari database berdasarkan range tanggal
        $data = Guest::whereDate('created_at', '>=', $start_date)
            ->whereDate('created_at', '<=', $end_date)
            ->select('room_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('room_id')
            ->get();

        // Tampilkan data ke dalam view
        return view('backend.receptionist.penjualan', compact('data'));
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
    public function show(PenjualanKamar $penjualanKamar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjualanKamar $penjualanKamar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjualanKamar $penjualanKamar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenjualanKamar $penjualanKamar)
    {
        //
    }
}
