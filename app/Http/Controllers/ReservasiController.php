<?php

namespace App\Http\Controllers;

use App\Models\reservasi;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.receptionist.reservasi');
    }

    public function cekKamar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'check_in' => [
                'required',
                'date',
                'after_or_equal:today', // Tanggal check-in harus sama dengan atau setelah hari ini
            ],
            'check_out' => [
                'required',
                'date',
                'after:check_in', // Tanggal check-out harus setelah tanggal check-in
            ],
        ]);

        // Cek validasi
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');

        $availableRooms = Visibility::whereDoesntHave('Room', function ($query) use ($checkIn, $checkOut) {
            $query->where(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '>=', $checkIn)
                    ->where('check_in', '<', $checkOut);
            })->orWhere(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_out', '>', $checkIn)
                    ->where('check_out', '<=', $checkOut);
            })->orWhere(function ($q) use ($checkIn, $checkOut) {
                $q->where('check_in', '<=', $checkIn)
                    ->where('check_out', '>=', $checkOut);
            });
        })
            ->whereHas('Room', function ($query) {
                $query->where('status', 'Aktif');
            })
            ->get();

        session(['check_in' => $checkIn, 'check_out' => $checkOut]);

        return view('backend.receptionist.daftarkamar', compact('availableRooms', 'checkIn', 'checkOut'));
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
    public function show(reservasi $reservasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reservasi $reservasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reservasi $reservasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reservasi $reservasi)
    {
        //
    }
}
