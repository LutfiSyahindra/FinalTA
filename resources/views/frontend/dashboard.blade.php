@extends('frontend.layouts.mainds')
@push('style-alt')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@endpush
@section('content')
<!-- banner starts -->
<section class="banner overflow-hidden">
    <div class="slider top50">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slide-inner">
                        <div class="slide-image"
                            style="background-image:url({{ asset('frontend/images/slider/bar1.jpg') }});"></div>
                        <div class="swiper-content">
                            <div class="entry-meta mb-2">
                                <h5 class="entry-category mb-0 white">Amazing Places</h5>
                            </div>
                            <h1 class="mb-2"><a class="white">Make Your Trip Fun & Noted</a>
                            </h1>
                            <p class="white mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                        </div>
                        <div class="dot-overlay"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner">
                        <div class="slide-image"
                            style="background-image:url({{ asset('frontend/images/slider/bar2.jpg') }})"></div>
                        <div class="swiper-content">
                            <div class="entry-meta mb-2">
                                <h5 class="entry-category mb-0 white">Explore Travel</h5>
                            </div>
                            <h1 class="mb-2"><a class="white">Start Planning Your Dream Trip</a>
                            </h1>
                            <p class="white mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                        </div>
                        <div class="dot-overlay"></div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slide-inner">
                        <div class="slide-image"
                            style="background-image:url({{ asset('frontend/images/slider/bar3.jpg') }})"></div>
                        <div class="swiper-content">
                            <div class="entry-meta mb-2">
                                <h5 class="entry-category mb-0 white">Road To Travel</h5>
                            </div>
                            <h1 class="mb-2"><a class="white">Begin your adventure with us</a>
                            </h1>
                            <p class="white mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                        </div>
                        <div class="dot-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</section>
<!-- banner ends -->

<!-- form main starts -->
<div class="form-main">
    <div class="section-shape top-0" style="background-image: url({{ asset('frontend/images/shape-pat.png') }});"></div>
    <div class="container">
        <form action="{{ route('cari.cariKamar') }}" method="POST">
            @csrf
            <div class="row align-items-center form-content rounded position-relative ms-5 me-5">
                <div class="col-lg-2 p-0">
                    <h4
                        class="form-title form-title1 text-center p-4 py-5 white bg-theme mb-0 rounded-start d-lg-flex align-items-center">
                        <i class="icon-location-pin fs-1 me-1"></i> Find Your Rooms
                    </h4>
                </div>
                <div class="col-lg-10 px-4">
                    <div class="form-content-in d-lg-flex align-items-center">
                        <div class="form-group me-2">
                            <div class="input-box">
                                <div class="text">Check-in</div>
                                <input type="date" name="check_in" placeholder="check-in">
                            </div>
                        </div>
                        <div class="form-group me-2">
                            <div class="input-box">
                                <div class="text">Check-out</div>
                                <input type="date" name="check_out" placeholder="check-out">
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button type="submit" class="nir-btn w-100" style="margin-top: 23px"
                                onclick="cari(event)">Cari Kamar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('bawah')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function cari(event) {
        event.preventDefault(); // Mencegah pengiriman form secara default

        const checkInDate = document.querySelector('input[name="check_in"]');
        const checkOutDate = document.querySelector('input[name="check_out"]');

        if (!checkInDate.value || !checkOutDate.value) {
            Swal.fire({
                title: 'Error',
                text: 'Mohon isi tanggal check-in dan check-out',
                icon: 'warning',
                button: 'OK',
                closeOnClickOutside: false, // Mencegah penutupan Sweet Alert ketika diklik di luar kotak
            });
        } else {
            const today = new Date();
            const selectedCheckInDate = new Date(checkInDate.value);
            const selectedCheckOutDate = new Date(checkOutDate.value);

            if (selectedCheckInDate.getTime() === selectedCheckOutDate.getTime()) {
                Swal.fire({
                    title: 'Error',
                    text: 'Tanggal check-in dan check-out tidak boleh sama',
                    icon: 'warning',
                    button: 'OK',
                    closeOnClickOutside: false,
                });
            } else if (selectedCheckInDate < today || selectedCheckOutDate < today) {
                Swal.fire({
                    title: 'Error',
                    text: 'Tanggal check-in dan check-out harus sama dengan atau setelah hari ini',
                    icon: 'warning',
                    button: 'OK',
                    closeOnClickOutside: false,
                });
            } else {
                // Lanjutkan dengan pengiriman form atau tindakan lain yang diperlukan
                event.target.closest('form').submit();
            }
        }
    }
</script>
{{-- <script>
    function submitForm(event) {
                event.preventDefault();
                document.querySelector('form').submit();
            }
</script> --}}
@endpush