<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingModelController;
use App\Http\Controllers\DaftarTamuController;
use App\Http\Controllers\Dashboarduser;
use App\Http\Controllers\Duser;
use App\Http\Controllers\DuserController;
use App\Http\Controllers\FasilController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FindController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\PenjualanKamarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservasiController;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VisibilityController;
use App\Models\CashOpname;
use App\Models\Guest;
use App\Models\Opname;
use App\Models\Order;
use App\Models\Profuser;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('backend.login');
});

Route::get('/', function () {
    return view('frontend.dashboard');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['redirectIfNotAuthenticated'])->group(function () {
    // Routes for reservation
    Route::get('/book/{id}', [DuserController::class, 'book'])->name('book.book');
    // ...
});
Route::get('/listkamar', [DuserController::class, 'listkamar']);
Route::get('/detail/{id}', [DuserController::class, 'show'])->name('detail.show');
Route::post('/cari', [DuserController::class, 'cariKamar'])->name('cari.cariKamar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // route master data manager
    Route::resource('room', RoomController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('service', FasilitasController::class);

    // Route CashOp
    Route::resource('co', KeuanganController::class);
    Route::post('/uang', [KeuanganController::class, 'uang']);
    Route::get('/uang1', [KeuanganController::class, 'uang1']);

    // route guest
    Route::resource('booking', GuestController::class);
    Route::get('/trans', GuestController::class . '@transaksi')->name('trans.transaksi');
    Route::resource('visit', VisibilityController::class);
    Route::resource('daftartamu', DaftarTamuController::class);
    Route::get('/pesan/{id}', GuestController::class . '@pesan')->name('pesan.pesan');


    // daftar tamu
    Route::get('/cin', DaftarTamuController::class . '@checkin')->name('cin.checkin');
    Route::get('/cot', DaftarTamuController::class . '@checkout')->name('cot.checkout');
    Route::get('/inv', DaftarTamuController::class . '@invoice')->name('inv.invoice');
    Route::get('/inv', DaftarTamuController::class . '@invoice')->name('inv.invoice');
    Route::post('/ci/{id}', DaftarTamuController::class . '@check_in')->name('ci.check_in');

    Route::resource('reservasi', ReservasiController::class);
    Route::post('/cekKamar', [ReservasiController::class, 'cekKamar'])->name('cekKamar.cekKamar');
    // Route::resource('find', FindController::class);

    // Report Penjualan Kamar
    Route::resource('penjualan', PenjualanKamarController::class);
    Route::get('/filter', [PenjualanKamarController::class, 'filter']);

    Route::resource('duser', DuserController::class);
    // Route::get('/listkamar', [DuserController::class, 'listkamar']);
    // Route::get('/detail/{id}', [DuserController::class, 'show'])->name('detail.show');
    // Route::post('/cari', [DuserController::class, 'cariKamar'])->name('cari.cariKamar');
    Route::get('/book/{id}', [DuserController::class, 'book'])->name('book.book');
    Route::get('/confirm', [DuserController::class, 'confirm'])->name('confirm.confirm');

    // Route::get('/pdf', [KeuanganController::class, 'pdf'])->name('pdf.pdf');
    Route::get('/pdf', [KeuanganController::class, 'pdf'])->name('pdf.pdf');

    Route::resource('opname', OpnameController::class);
    Route::post('/income', [OpnameController::class, 'income']);
    Route::post('/store', [OpnameController::class, 'store']);

    Route::get('/profile', [DuserController::class, 'profile']);
    Route::put('/profup/{id}', [DuserController::class, 'profup'])->name('profup.profup');
    Route::post('/profile', [DuserController::class, 'profilebaru'])->name('profile.profilebaru');
    Route::post('/pay', [DuserController::class, 'pay']);
    Route::get('/mybooking', [DuserController::class, 'mybooking']);
    Route::get('/detailbooking/{id}', [DuserController::class, 'detailbooking'])->name('detailbooking.detailbooking');
    Route::get('/cetak', [DuserController::class, 'generatePDF']);
});

// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
// });

Route::get('/cekRelasi', function () {
    return Order::with(['detailTransaksi.Fasilitas'])->get();
});

// Route::get('karyawan', KaryawanController::class,'__invoke');
// Route::resource('role', RoleController::class);

require __DIR__ . '/auth.php';
