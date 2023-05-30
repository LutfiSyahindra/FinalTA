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
                <h1 class="mb-3">Booking</h1>
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Booking</li>
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
            <div class="col-lg-8 mb-4">
                <div class="payment-book">
                    <div class="booking-box">
                        <div class="customer-information mb-4">
                            <form method="GET" action="{{ route('confirm.confirm') }}" id="update-profile-form">
                                @csrf
                                <h3 class="border-b pb-2 mb-2">Guest Information</h3>
                                <h5>Let us know who you are</h5>
                                <div class="row">
                                    {{-- <div class="col-md-2">
                                        <div class="form-group mb-2">
                                            <label>Title</label>
                                            <div class="input-box">
                                                <select class="niceSelect">
                                                    <option value="0">Select</option>
                                                    <option value="1">Mr.</option>
                                                    <option value="2">Mrs.</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>Name</label>
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>NIK</label>
                                            <input type="text" name="nik" placeholder="Nik">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>No Telephone</label>
                                            <input type="text" name="no_tlp" placeholder="Phone No.">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" name="jk" placeholder="Jenis Kelamin">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="address" placeholder="Alamat">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="customer-information mb-4 d-flex align-items-center bg-grey rounded p-4">
                            <i class="fa fa-grin-wink rounded fs-1 bg-theme white p-3 px-4"></i>
                            <div class="customer-info ps-4">
                                <h6 class="mb-1">Good To Know:</h6>
                                <small>Free Cancellation until 14:00 pn 11 Feb 2022</small>
                            </div>
                        </div>
                        {{-- <button type="submit" class="nir-btn white" onclick="submitForm(event)">Lanjutkan
                            Pemesanan</button> --}}
                    </div>

                </div>
            </div>

            <div class="col-lg-4 mb-4 ps-ld-4">
                <div class="sidebar-sticky">
                    <div class="sidebar-item bg-white rounded box-shadow overflow-hidden p-3 mb-4">
                        <h4>Your Booking Details</h4>
                        <div class="trend-full border-b pb-2 mb-2">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="trend-item2 rounded">
                                        <a href="destination-single1.html"
                                            style="background-image: url({{ asset('storage/backend/assets/images/room/'.$room->img) }});"></a>
                                        <div class="color-overlay"></div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-8 ps-0">
                                    <div class="trend-content position-relative">
                                        <h5 class="mb-1">{{ $room->room }}</h5>
                                        <h6 class="theme mb-0">Rp {{ number_format($room->harga, 0, ',', '.') }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="trend-check border-b pb-2">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="trend-check-item bg-grey rounded p-3 mb-2">
                                        <p class="mb-0">Check In</p>
                                        <h6 class="mb-0">{{ $checkIn }}</h6>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="trend-check-item bg-grey rounded p-3 mb-2">
                                        <p class="mb-0">Check Out</p>
                                        <h6 class="mb-0">{{ $checkOut }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="trend-check border-b pb-2 mb-2">
                            <p class="mb-0">Total Length of Stay:</p>
                            <h6 class="mb-0">{{ $tot }} Days | {{ $malam }} Nights </h6>
                            <small><a href="#" class="theme text-decoration-underline">travelling on different
                                    dates?</a></small>
                        </div>
                        <div class="trend-check">
                            <p class="mb-0">Fasilitas Tambahan:</p>
                            @foreach ($fasilitas as $item)
                            <div class="form-check">
                                <input class="form-check-input additional-facility" type="checkbox"
                                    value="{{ $item->id }}" id="facility_{{ $item->id }}" name="fasilitas[]"
                                    data-fasilitas="{{ $item->fasilitas }}" data-harga="{{ $item->harga }}" {{
                                    in_array($item->id, old('fasilitas', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="facility_{{ $item->id }}">
                                    {{ $item->fasilitas }} | Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="nir-btn white" onclick="submitForm(event)">Lanjutkan
                            Pemesanan</button>
                    </div>
                </div>
                </form>
            </div>
</section>
@endsection

@push('bawah')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function submitForm(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Konfirmasi Pemesanan',
                text: 'Apakah Anda yakin ingin melanjutkan pemesanan?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.querySelector('#update-profile-form').submit();
                }
            });
        }
</script>
@endpush
<!-- top Destination ends -->