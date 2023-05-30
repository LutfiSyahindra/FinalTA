<?php

namespace App\Http\Controllers;

use App\Models\DaftarTamu;
use App\Models\DetailTransaksi;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Visibility;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DaftarTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tamu = Guest::where('status', 'reservasi')->get();
            return DataTables::of($tamu)
                ->addIndexColumn()
                ->addColumn('kamar', function ($tamu) {
                    return strtoupper($tamu->room->room);
                })
                ->addColumn('Nama Tamu', function ($tamu) {
                    return strtoupper($tamu->name);
                })
                ->addColumn('NIK', function ($tamu) {
                    return strtoupper($tamu->nik);
                })
                ->addColumn('Jenis Kelamin', function ($tamu) {
                    return strtoupper($tamu->jk);
                })
                ->addColumn('No-Telp', function ($tamu) {
                    return strtoupper($tamu->no_tlp);
                })
                ->addColumn('Alamat', function ($tamu) {
                    return strtoupper($tamu->address);
                })
                ->addColumn('Check-in', function ($tamu) {
                    return strtoupper($tamu->check_in);
                })
                ->addColumn('Check-out', function ($tamu) {
                    return strtoupper($tamu->check_out);
                })
                ->addColumn('harga', function ($tamu) {
                    return 'Rp.' . number_format($tamu->total);
                })
                ->addColumn('status', function ($tamu) {
                    if ($tamu->status == 'reservasi') {
                        return '<span class="btn btn-success">' . ucfirst($tamu->status) . '</span>';
                    } elseif ($tamu->status == 'check-in') {
                        return '<span class="btn btn-primary">' . ucfirst($tamu->status) . '</div>';
                    } elseif ($tamu->status == 'check-out') {
                        return '<span class="btn btn-danger">' . ucfirst($tamu->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($tamu) {
                    if ($tamu->status == 'reservasi') {
                        $button = '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                        $class = 'primary';
                        $title = 'Check-in';
                        $id = 'check-in';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="show-tamu" data-id="' . $tamu->id . '" title="Show" class="btn btn-success show-tamu"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . "<button id='show-invoice' style='margin-left:5px' data-id='" . $tamu->id . "' title='invoice' class='btn btn-warning show-invoice' onclick='openInvoiceModal(" . $tamu->id . ")'><i class='fa fa-credit-card' aria-hidden='true'></i></button>";

                    $btn = $btn . ' <button id="delete-tamu" data-id="' . $tamu->id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        // $room = Room::all();
        return view('backend.receptionist.daftartamu');
    }

    public function checkin(Request $request)
    {
        if ($request->ajax()) {
            $tamu = Guest::where('status', 'check-in')->get();
            return DataTables::of($tamu)
                ->addIndexColumn()
                ->addColumn('kamar', function ($tamu) {
                    return strtoupper($tamu->room->room);
                })
                ->addColumn('Nama Tamu', function ($tamu) {
                    return strtoupper($tamu->name);
                })
                ->addColumn('NIK', function ($tamu) {
                    return strtoupper($tamu->nik);
                })
                ->addColumn('Jenis Kelamin', function ($tamu) {
                    return strtoupper($tamu->jk);
                })
                ->addColumn('No-Telp', function ($tamu) {
                    return strtoupper($tamu->no_tlp);
                })
                ->addColumn('Alamat', function ($tamu) {
                    return strtoupper($tamu->address);
                })
                ->addColumn('Check-in', function ($tamu) {
                    return strtoupper($tamu->check_in);
                })
                ->addColumn('Check-out', function ($tamu) {
                    return strtoupper($tamu->check_out);
                })
                ->addColumn('harga', function ($tamu) {
                    return 'Rp.' . number_format($tamu->total);
                })
                ->addColumn('status', function ($tamu) {
                    if ($tamu->status == 'reservasi') {
                        return '<span class="btn btn-success">' . ucfirst($tamu->status) . '</span>';
                    } elseif ($tamu->status == 'check-in') {
                        return '<span class="btn btn-primary">' . ucfirst($tamu->status) . '</div>';
                    } elseif ($tamu->status == 'check-out') {
                        return '<span class="btn btn-danger">' . ucfirst($tamu->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($tamu) {
                    if ($tamu->status == 'check-in') {
                        $button = '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                        $class = 'primary';
                        $title = 'Check-in';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="show-tamu" data-id="' . $tamu->id . '" title="Show" class="btn btn-success show-tamu"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . ' <button id="delete-tamu" data-id="' . $tamu->id . '" class="btn btn-' . $class . ' btn-md" title="' . $title . '">' . $button . '</button>';

                    $btn .= "<button id='show-invoice' style='margin-left:5px' data-id='" . $tamu->id . "' title='invoice' class='btn btn-warning show-invoice'><i class='fa fa-credit-card' aria-hidden='true'></i></button>";

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        // $room = Room::all();
        return view('backend.receptionist.daftartamu');
    }

    public function checkout(Request $request)
    {
        if ($request->ajax()) {
            $tamu = Guest::where('status', 'check-out')->get();
            return DataTables::of($tamu)
                ->addIndexColumn()
                ->addColumn('kamar', function ($tamu) {
                    return strtoupper($tamu->room->room);
                })
                ->addColumn('Nama Tamu', function ($tamu) {
                    return strtoupper($tamu->name);
                })
                ->addColumn('NIK', function ($tamu) {
                    return strtoupper($tamu->nik);
                })
                ->addColumn('Jenis Kelamin', function ($tamu) {
                    return strtoupper($tamu->jk);
                })
                ->addColumn('No-Telp', function ($tamu) {
                    return strtoupper($tamu->no_tlp);
                })
                ->addColumn('Alamat', function ($tamu) {
                    return strtoupper($tamu->address);
                })
                ->addColumn('Check-in', function ($tamu) {
                    return strtoupper($tamu->check_in);
                })
                ->addColumn('Check-out', function ($tamu) {
                    return strtoupper($tamu->check_out);
                })
                ->addColumn('harga', function ($tamu) {
                    return 'Rp.' . number_format($tamu->total);
                })
                ->addColumn('status', function ($tamu) {
                    if ($tamu->status == 'reservasi') {
                        return '<span class="btn btn-success">' . ucfirst($tamu->status) . '</span>';
                    } elseif ($tamu->status == 'check-in') {
                        return '<span class="btn btn-primary">' . ucfirst($tamu->status) . '</div>';
                    } elseif ($tamu->status == 'check-out') {
                        return '<span class="btn btn-danger">' . ucfirst($tamu->status) . '</div>';
                    }
                })
                ->addColumn('action', function ($tamu) {
                    if ($tamu->status == 'reservasi') {
                        $button = '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                        $class = 'primary';
                        $title = 'Check-in';
                    } else {
                        $title = 'Aktifkan';
                        $class = 'warning';
                        $button = '<i class="fa fa-undo"></i>';
                    }

                    $btn = '<button id="show-tamu" data-id="' . $tamu->id . '" title="Show" class="btn btn-success show-tamu"><i class="fa fa-eye"></i></button>';

                    $btn = $btn . "<button id='show-invoice' style='margin-left:5px' data-id='" . $tamu->id . "' title='invoice' class='btn btn-warning show-invoice' onclick='openInvoiceModal(" . $tamu->id . ")'><i class='fa fa-credit-card' aria-hidden='true'></i></button>";


                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        // $room = Room::all();
        return view('backend.receptionist.daftartamu');
    }

    public function invoice(Request $request, $id)
    {
        $tamu = Guest::where('id', $id)->first();

        return view('backend.receptionist.invoice', compact($tamu));
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
    public function show($id)
    {
        $invoice = Guest::findOrFail($id);
        return response()->json($invoice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $daftarTamu = Guest::with('room_id')->find($id);
        return response()->json($daftarTamu);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarTamu $daftarTamu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $daftarTamu = Guest::find($id);

        if ($daftarTamu->status == 'reservasi') {
            Guest::where('id', $id)->update([
                'status' => 'check-in',
            ]);
            return response()->json(['status' => 'Berhasil Check-in']);
        } else {
            Guest::where('id', $id)->update([
                'status' => 'check-out',
            ]);

            Visibility::where('room_id', $daftarTamu->room_id)->update([
                'check_in' => null,
                'check_out' => null,
            ]);

            Visibility::where('room_id', $daftarTamu->room_id)->update([
                'status' => 'Available',
            ]);
            return response()->json(['status' => 'Berhasil Check-out']);
        }
    }
}
