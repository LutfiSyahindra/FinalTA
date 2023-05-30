@extends('frontend.layouts.mainds')
@section('content')
<section class="breadcrumb-main pb-20 pt-14" style="background-image: url({{ asset('frontend/images/shape8.png') }});">
    <div class="section-shape section-shape1 top-inherit bottom-0"
        style="background-image: url({{ asset('frontend/images/shape8.png') }});">
    </div>
    <div class="breadcrumb-outer">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <h1 class="mb-3">My Booking</h1>
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Booking</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <div class="dot-overlay"></div>
</section>
<section class="trending pt-6 pb-0 bg-lgrey">
    <div class="container">
        <div class="row">
            @foreach ($orders as $booking)
            <div class="col-lg-4 mb-4 ps-ld-4">
                <div class="sidebar-sticky">
                    <div class="sidebar-item bg-white rounded box-shadow overflow-hidden p-3 mb-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col">
                                <div class="trend-content position-relative">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1"><a>{{ $booking->room }}</a></h5>
                                        @if ($booking->status_pembayaran == 'pending')
                                        <h5 class="mb-1"><a
                                                href="{{ route('detailbooking.detailbooking',$booking->id) }}"
                                                class="btn btn-danger"><i class="fa fa-money"></i>
                                                {{
                                                $booking->status_pembayaran }}</a></h5>
                                        @else
                                        <h5 class="mb-1"><a
                                                href="{{ route('detailbooking.detailbooking',$booking->id) }}"
                                                class="btn btn-success"><i class="fa fa-money"></i> Detail Booking</a>
                                        </h5>
                                        @endif
                                        {{-- <a type="submit" class="nir-btn-black" onclick="submitForm(event)"><i
                                                class="fa fa-money"></i> Pay</a> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="trend-check-item bg-grey rounded p-3 mb-2">
                                                <p class="mb-0">Check In</p>
                                                <h6 class="mb-0">{{ $booking->check_in }}</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="trend-check-item bg-grey rounded p-3 mb-2">
                                                <p class="mb-0">Check Out</p>
                                                <h6 class="mb-0">{{ $booking->check_out }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- top Destination ends -->

<!-- Discount action starts -->

<!-- partner ends -->
@endsection
<script>
    function submitForm(event) {
                event.preventDefault();
                document.querySelector('form').submit();
            }
</script>