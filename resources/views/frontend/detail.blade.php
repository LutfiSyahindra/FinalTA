@extends('frontend.layouts.mainds')
@push('style-alt')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@endpush

@section('content')
<!-- BreadCrumb Starts -->
<section class="breadcrumb-main pb-20 pt-14" style="background-image: url(images/bg/bg1.jpg);">
    <div class="section-shape section-shape1 top-inherit bottom-0"
        style="background-image: url({{ asset('frontend/images/shape8.png') }});">
    </div>
    <div class="breadcrumb-outer">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1 class="mb-3">{{ $room->room }}</h1>
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Room Details</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="dot-overlay"></div>
</section>
<!-- BreadCrumb Ends -->

<!-- top Destination starts -->
<section class="trending pt-6 pb-0 bg-lgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-max">
                <div class="single-content">
                    <div id="highlight" class="mb-4">
                        <div class="single-full-title border-b mb-2 pb-2">
                            <div class="single-title">
                                <h2 class="mb-1">{{ $room->room }}</h2>
                            </div>
                            {{-- <div class="register-login d-flex align-items-center">
                                <a href="{{ route('book.book', $room->id) }}" class="nir-btn white book-btn">Book
                                    Now</a>
                            </div> --}}
                        </div>

                        <div class="description-images mb-2">
                            <img src="{{ asset('storage/backend/assets/images/room/'.$room->img) }}"
                                alt="{{ $room->room }}" class="w-100 rounded">
                        </div>

                        <div class="description mb-2">
                            <h4>Description</h4>
                            <p>{{ $room->deskripsi }}.</p>
                        </div>

                        <div class="description d-md-flex">
                            <div class="desc-box bg-grey p-4 rounded me-md-2 mb-2">
                                <h5 class="mb-2">Price Includes</h5>
                                <ul>
                                    <li class="d-block pb-1"><i class="fa fa-check pink mr-1"></i> Air Fares</li>
                                    <li class="d-block pb-1"><i class="fa fa-check pink mr-1"></i> 3 Nights Hotel
                                        Accommodation</li>
                                    <li class="d-block pb-1"><i class="fa fa-check pink mr-1"></i> Tour Guide</li>
                                    <li class="d-block"><i class="fa fa-check pink mr-1"></i> Entrance Fees</li>
                                </ul>
                            </div>
                            <div class="desc-box bg-grey p-4 rounded ms-md-2 mb-2">
                                <h4 class="mb-2">Departure & Return Location</h4>
                                <ul>
                                    <li class="d-block pb-1"><i class="fa fa-close pink mr-1"></i> Guide Service Fee
                                    </li>
                                    <li class="d-block pb-1"><i class="fa fa-close pink mr-1"></i> Driver Service Fee
                                    </li>
                                    <li class="d-block pb-1"><i class="fa fa-close pink mr-1"></i> Any Private Expenses
                                    </li>
                                    <li class="d-block"><i class="fa fa-close pink mr-1"></i> Room Service Fees</li>
                                </ul>
                            </div>
                            <div class="">
                                <a href="{{ route('book.book', $room->id) }}" class="nir-btn white book-btn">Book
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- top Destination ends -->
@endsection

@push('bawah')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelector('.book-btn').addEventListener('click', function(event) {
    // Cek apakah pengguna sudah login atau belum
    if (!{!! Auth::check() ? 'true' : 'false' !!}) {
        // Tampilkan Sweet Alert
        Swal.fire({
            title: 'Alert',
            text: 'Silahkan Login Untuk Melanjutkan',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ok',
            cancelButtonText: 'Batal'
        });
        // Mencegah aksi default tombol
        event.preventDefault();
    }
});
</script>
@endpush