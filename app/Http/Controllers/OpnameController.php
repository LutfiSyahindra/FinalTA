<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Opname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class OpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $opname = Opname::all();
            return DataTables::of($opname)
                ->addIndexColumn()
                ->addColumn('Periode Awal', function ($opname) {
                    return strtoupper($opname->start_date);
                })
                ->addColumn('Periode Akhir', function ($opname) {
                    return strtoupper($opname->end_date);
                })
                ->addColumn('Total Income', function ($opname) {
                    return strtoupper($opname->total_income);
                })
                ->addColumn('Opening Balanced', function ($opname) {
                    return strtoupper($opname->open);
                })
                ->addColumn('Total Cash', function ($opname) {
                    return strtoupper($opname->total);
                })
                ->addColumn('Jumlah Kas', function ($opname) {
                    return strtoupper($opname->jml_kas);
                })
                ->addColumn('Rekonsiliasi', function ($opname) {
                    return strtoupper($opname->rekonsiliasi);
                })
                // ->addColumn('status', function ($tamu) {
                //     if ($tamu->status == 'reservasi') {
                //         return '<span class="btn btn-success">' . ucfirst($tamu->status) . '</span>';
                //     } elseif ($tamu->status == 'check-in') {
                //         return '<span class="btn btn-primary">' . ucfirst($tamu->status) . '</div>';
                //     } elseif ($tamu->status == 'check-out') {
                //         return '<span class="btn btn-danger">' . ucfirst($tamu->status) . '</div>';
                //     }
                // })
                ->addColumn('action', function ($opname) {
                    // if ($tamu->status == 'check-in') {
                    //     $button = '<i class="fa fa-sign-in" aria-hidden="true"></i>';
                    //     $class = 'primary';
                    //     $title = 'Check-in';
                    // } else {
                    //     $title = 'Aktifkan';
                    //     $class = 'warning';
                    //     $button = '<i class="fa fa-undo"></i>';
                    // }

                    $btn = '<button id="show-tamu" data-id="' . $opname->id . '" title="Show" class="btn btn-success show-tamu"><i class="fa fa-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        // $visit = Visibility::all();
        // return view('backend.receptionist.visibility',compact('visit'));

        // $room = Room::all();
        return view('backend.receptionist.opname');
    }

    public function income(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $open = $request->input('open');
        $income = $request->input('total_income');

        $total_income = Guest::whereBetween('created_at', [$start_date, $end_date])->sum('total');
        $hasil = $total_income + $open;

        return response()->json([
            'total_income' => number_format($total_income, 0, ',', '.'),
            // 'hasil' => number_format($hasil, 0, ',', '.'),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Opname;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;
        $data->total_income = $request->total_income;
        $data->open = $request->open;
        $data->total = $request->cash;
        $data->jml_kas = $request->kas;
        $data->rekonsiliasi = $request->rekon;
        $data->alasan = $request->alasan;
        $data->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        //define validation rules
        //define validation rules
        // $validator = Validator::make($request->all(), [
        //     // 'room' => 'required|unique:rooms,room',
        //     'cash' => 'required',
        //     'kas' => 'required',
        //     // 'img_pelatih' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()->all()]);
        // }

        // return response()->json($request->all());
        // $start_date = $request->input('start_date');
        // $end_date = $request->input('end_date');
        // $total_income = $request->input('total_income');
        // $open = $request->input('open');
        // $cash = $request->input('cash');
        // $kas = $request->input('kas');
        // $rekon = $request->input('rekon');

        // // Store Data or Update Data
        // $opname = Opname::updateOrCreate(
        //     [
        //         'id' => $request->input('id'),
        //     ],
        //     [
        //         'start_date' => $request->$start_date,
        //         'end_date' => $request->$end_date,
        //         'total_income' => $request->$total_income,
        //         'open' => $request->$open,
        //         'total' => $request->$cash,
        //         'jml_kas' => $request->$kas,
        //         'rekonsiliasi' => $request->$rekon,
        //     ],
        // );

        // return response()->json(['success' => 'Room saved successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Opname::findOrFail($id);
        return view('backend.receptionist.opname', compact('opname'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $opname = Opname::find($id);

        return response()->json($opname);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opname $opname)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opname $opname)
    {
        //
    }
}
