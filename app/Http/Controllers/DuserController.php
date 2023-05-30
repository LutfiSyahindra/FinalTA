<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Fasilitas;
use App\Models\Guest;
use App\Models\Order;
use App\Models\Profuser;
use App\Models\Room;
use App\Models\Visibility;
use Barryvdh\DomPDF\PDF;
use DateTime;
use Egulias\EmailValidator\Result\Reason\DetailedReason;
// use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use RealRashid\SweetAlert\Facades\Alert;
use RealRashid\SweetAlert\Facades\Alert;

class DuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::all();
        return view('frontend.dashboard', compact('room'));
    }

    public function listkamar()
    {
        $room = Room::all();
        return view('frontend.listkmr', compact('room'));
    }

    // public function book(Request $request,$id)
    // {
    //     $user = Auth::user();
    //     $profile = $user->Profuser;
    //     $room = Room::where('id', $id)->first();
    //     $fasilitas = Fasilitas::all();

    //    $selectedFacilities = [];
    //     $fasilitas = $request->input('fasilitas');

    //     foreach ($fasilitas as $facilityId) {
    //         $facility = Fasilitas::find($facilityId);

    //         if ($facility) {
    //             $selectedFacilities[] = [
    //                 'name' => $facility->fasilitas,
    //                 'price' => $facility->harga
    //             ];
    //         }
    //     }
    //     return view('frontend.book', compact('room', 'fasilitas', 'profile', 'selectedFacilities'));
    // }
    public function book(Request $request, $id)
    {

        $user = Auth::user();
        $profile = $user->Profuser;

        $name = $request->input;
        $nik = $profile->nik ?? '';
        $noTlp = $profile->no_tlp ?? '';
        $jk = $profile->jk ?? '';
        $address = $profile->address ?? '';
        $email = $profile->email ?? '';

        $room = Room::where('id', $id)->first();
        $fasilitas = Fasilitas::where('status', 'Aktif')->get();

        $selectedFacilities = [];

        $selectedFacilityIds = $request->input('fasilitas', []);

        $checkIn = session('check_in');
        $checkOut = session('check_out');

        // menghitung hari
        $tg1 = new DateTime($checkIn);
        $tg2 = new DateTime($checkOut);
        $gl = $tg2->diff($tg1);
        $malam = $gl->days - 1;

        // menghitung malam
        $tgl1 = new DateTime($checkIn);
        $tgl2 = new DateTime($checkOut);
        $totgl = $tgl2->diff($tgl1);
        $tot = $totgl->days;

        $kmr = $room->harga;
        $kmrtot = $kmr * $tot;

        session()->put('booking_details', [
            'room_id' => $room->id,
            'room' => $room->room,
            'hargakmr' => $room->harga,
            'checkIn' => $checkIn,
            'checkOut' => $checkOut,
            'fasilitas' => $selectedFacilities,
            'kmrtot' => $kmrtot,
            'totkmr' => $kmrtot,
        ]);
        // dd(session('booking_details'));

        return view('frontend.book', compact('room', 'fasilitas', 'profile', 'selectedFacilities', 'checkIn', 'checkOut', 'tot', 'malam', 'name'));
    }


    public function profile()
    {
        $user = Auth::user();
        $profile = $user->Profuser;
        return view('frontend.profile', compact('user', 'profile'));
    }

    public function profup(Request $request)
    {
        $user = Auth::user();
        $profile = $user->Profuser;

        $profile->nama = $request->input('name');
        $profile->nik = $request->input('nik');
        $profile->jk = $request->input('jk');
        $profile->address = $request->input('address');
        $profile->no_tlp = $request->input('no_tlp');

        // Handle file upload for photo
        if ($request->hasFile('img')) {
            $photo = $request->file('img');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->storeAs('public/photos', $filename);
            $profile->photo = $filename;
        }

        $profile->save();

        return redirect()->back();
    }

    public function profilebaru(Request $request)
    {
        $validatedData = $request->validate([
            'img' => 'image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'jk' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
        ]);
        $user = Auth::user();
        $profile = new Profuser;
        $profile->nama = $validatedData['name'];
        $profile->nik = $validatedData['nik'];
        $profile->jk = $validatedData['jk'];
        $profile->address = $validatedData['address'];
        $profile->no_tlp = $validatedData['no_tlp'];
        $profile->email = $validatedData['email'];
        $profile->user_id = $user->id;

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imagePath = $image->store('photos', 'public');
            $profile->photo = $imagePath;
        }

        $profile->save();
        Alert::success('Success', 'Profile has been ' . (isset($profile) ? 'updated' : 'created') . ' successfully')->autoClose(5000);
        return redirect()->back();
    }

    public function cariKamar(Request $request)
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

        return view('frontend.listkmr', compact('availableRooms', 'checkIn', 'checkOut'));
    }

    public function confirm(Request $request)
    {
        // Validasi form jika diperlukan
        $validatedData = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'no_tlp' => 'required|string',
            'jk' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
        ]);

        // Menggunakan nilai yang dikirimkan melalui form
        $name = $request->input('name');
        $nik = $request->input('nik');
        $no_tlp = $request->input('no_tlp');
        $jk = $request->input('jk');
        $address = $request->input('address');
        $email = $request->input('email');

        $prefix = 'MH-';
        $randomNumber = mt_rand(1000, 9999);
        $bookingNumber = $prefix . $randomNumber;

        $hitung = 0;
        $fasilitas = [];

        if ($request->has('fasilitas')) {
            foreach ($request->fasilitas as $key => $value) {
                $fasilitas[] = [
                    'data' => Fasilitas::find($value),
                    // 'harga' => $key['harga'],
                ];

                $hitung += $value;
            }
        }

        $sums = [];
        foreach ($fasilitas as $index) { // loop over the IDs
            $sums[] += $index['data']['harga'];
        }
        $totalhargafasilitas = array_sum($sums);

        session()->put('fasilitas', [
            'fasilitas' => $fasilitas,
            'totalfasilitas' => $totalhargafasilitas
        ]);

        session()->put('biodata', [
            'nama' => $name,
            'nik' => $nik,
            'no_tlp' => $no_tlp,
            'jk' => $jk,
            'address' => $address,
            'email' => $email,
        ]);



        $barang = $hitung;
        // Mengakses data yang tersimpan dalam session
        $bookingDetails = session('booking_details');
        // dd($bookingDetails);

        $data = [
            'nama' => $name,
            'nik' => $nik,
            'tlp' => $no_tlp,
            'jk' => $jk,
            'address' => $address,
            'email' => $email,
            'room' => $bookingDetails['room'],
            'hargakmr' => $bookingDetails['hargakmr'],
            'checkIn' => $bookingDetails['checkIn'],
            'checkOut' => $bookingDetails['checkOut'],
            'totalkamar' => $bookingDetails['totkmr'],
            'kmrtot' => $bookingDetails['kmrtot'] + $totalhargafasilitas,
            'selectedFacilities' => $bookingDetails['fasilitas'],
        ];
        // dd($data);
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $bookingDetails['kmrtot'] + $totalhargafasilitas,
            ),
            'customer_details' => array(
                'first_name' => $data['nama'],
                'last_name' => '',
                'email' => $data['email'],
                'phone' => $data['tlp'],
            ),
        );
        // dd($params);

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // Mengambil nilai dari session booking_details
        // $profile bisa diakses jika sudah ada data $profile yang diambil dari user
        return view('frontend.confirm', compact('fasilitas', 'bookingNumber', 'data', 'snapToken'));
    }

    public function pay(Request $request)
    {
        $jsonData = $request->input('json');
        $result = json_decode($jsonData, true);
        // dd($result);
        $bookingDetails = session('booking_details');
        $user = Auth::user();
        $fasilitas = session('fasilitas');
        $biodata = session('biodata');

        $insert = Guest::create([
            'room_id' => $bookingDetails['room_id'],
            'name' => $biodata['nama'],
            'nik' => $biodata['nik'],
            'no_tlp' => $biodata['no_tlp'],
            'jk' => $biodata['jk'],
            'address' => $biodata['address'],
            'check_in' => $bookingDetails['checkIn'],
            'check_out' => $bookingDetails['checkOut'],
            'total' => $bookingDetails['kmrtot'] + $fasilitas['totalfasilitas'],
            'status' => 'reservasi',
            'status_pembayaran' => $result['transaction_status'],
        ]);

        $order = Order::create([
            'user_id' => $user->id,
            'room' => $bookingDetails['room'],
            'name' => $biodata['nama'],
            'nik' => $biodata['nik'],
            'no_tlp' => $biodata['no_tlp'],
            'jk' => $biodata['jk'],
            'address' => $biodata['address'],
            'check_in' => $bookingDetails['checkIn'],
            'check_out' => $bookingDetails['checkOut'],
            'total' => $bookingDetails['kmrtot'] + $fasilitas['totalfasilitas'],
            'harga_kamar' => $bookingDetails['totkmr'],
            'status_pembayaran' => $result['transaction_status'],
            'order_id' => $result['order_id'],
        ]);

        foreach ($fasilitas['fasilitas'] as $key) {
            foreach ($key as $item => $value) {
                // dd($value['data']['fasilitas']);
                DetailTransaksi::create([
                    'fasilitas_id' => $value['id'],
                    'guests_id' => $insert->id,
                    'orders_id' => $order->id,
                ]);
            }
        }

        Visibility::where('room_id', $insert['room_id'])->update([
            'check_in' => $insert['check_in'],
            'check_out' => $insert['check_out'],
            // 'status' => 'Pending',
        ]);



        return redirect()->route('detailbooking.detailbooking', ['id' => $order->id]);
    }

    public function midtrans(Request $request)
    {
        $bookingDetails = session('booking_details');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $bookingDetails['kmrtot'],
            ),
            'customer_details' => array(
                'first_name' => $bookingDetails['nama'],
                'last_name' => '',
                'email' => $bookingDetails['email'],
                'phone' => $bookingDetails['tlp'],
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
    }

    public function mybooking(Request $request)
    {
        $user = Auth::user();
        $room = Room::all();


        $orders = Order::where('user_id', $user->id)->get();
        return view('frontend.mybooking', compact('orders', 'room'));
    }
    public function detailbooking(Request $request, $id)
    {
        $orders = Order::with(['detailTransaksi.fasilitas'])->where('id', $id)->first();
        // $jsonData = $request->input('json');
        // $result = json_decode($jsonData, true);

        // \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        // $params = array(
        //     'transaction_details' => array(
        //         'order_id' => $orders->order_id,
        //         'gross_amount' => $orders->total,
        //     ),
        //     'customer_details' => array(
        //         'first_name' => $orders->name,
        //         'last_name' => '',
        //         'phone' => $orders->no_tlp,
        //     ),
        // );

        // $snapToken = \Midtrans\Snap::getSnapToken($params);
        // $fasil = DetailTransaksi::where('orders_id', $id)->get();
        return view('frontend.bookdetail', compact('orders'));
    }

    public function generatePDF()
    {
        $html = view('backend.receptionist.booking')->render();  // Ganti 'nama.view' dengan nama view yang sesuai
        $pdf = PDF::loadHTML($html);

        return $pdf->download('nama_file.pdf');  // Ganti 'nama_file.pdf' dengan nama file yang diinginkan
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('frontend.detail', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
