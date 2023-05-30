@extends('frontend.layouts.mainds')
@push('style-alt')
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>
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
                <h1 class="mb-3">Confirmation</h1>
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirmation</li>
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
            <div class="col-lg-8 col-xs-12 mb-4">
                <div class="payment-book">
                    <div class="booking-box">
                        <div
                            class="booking-box-title d-md-flex align-items-center bg-title p-4 mb-4 rounded text-md-start text-center">
                            <i class="fa fa-check px-4 py-3 bg-white rounded title fs-5"></i>
                            <div class="title-content ms-md-3">
                                <h3 class="mb-1 white">Thank You. Your booking order is confirmed now.</h3>
                                <p class="mb-0 white">A confirmation email has been sent to your provided email
                                    address.
                                </p>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th>Booking ID</th> --}}
                                        <th>kamar</th>
                                        <th>Check-In</th>
                                        <th>Check-Out</th>
                                        <th>Harga</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- <td class="theme2">{{ $bookingNumber }}</td> --}}
                                        <td class="theme2">{{ $orders->room }}</td>
                                        <td class="theme2">{{ $orders->check_in }}</td>
                                        <td class="theme2">{{ $orders->check_out }}</td>
                                        <td class="theme2">Rp {{ number_format($orders->harga_kamar, 0, ',', '.') }}
                                        </td>
                                        {{-- <td>Rp {{ number_format($hargakmr, 0, ',', '.') }}</td> --}}
                                        <td class="theme2">{{ $orders->status_pembayaran }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                     <div class="table-responsive">
                         <h4>Bill Information</h4>
                         <table class="table">
                          
                                @foreach ($orders->detailTransaksi as $fasil)
                                <tr>
                                    <td>{{ $fasil->Fasilitas->fasilitas}}</td>
                                    <td>Rp {{ number_format($fasil->Fasilitas->harga) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="color: black; font-weight: bold;">Grand Total</td>
                                    <td style="color: black; font-weight: bold;">Rp {{
                                        number_format($orders->total, 0,
                                        ',',
                                        '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <h4>Guest Information</h4>
                            <table class="table-responsive">
                                <tr>
                                    <td>Booking Number</td>
                                    <td>5784-BD245</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $orders->name }}</td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>{{ $orders->nik }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $orders->jk }}</td>
                                </tr>
                                <tr>
                                    <td>No Telephone</td>
                                    <td>{{ $orders->no_tlp }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $orders->address }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="booking-border mb-4">
                            <h4 class="border-b pb-2 mb-2">Payment</h4>
                            <p class="mb-0">This is the third time I've used Travelo Website and telling you the
                                truth
                                their services are always reliable and it only takes a few minutes to plan and
                                finalize.
                            </p>
                            <a href="#">Payment is made by Credit Card via Paypal</a>
                        </div>
                        <div class="booking-border mb-4">
                            <h4 class="border-b pb-2 mb-2">View Booking Details</h4>
                            <p class="mb-0">This is the third time I've used Travelo Website and telling you the
                                truth
                                their services are always reliable and it only takes a few minutes to plan and
                                finalize.
                            </p>
                            <a href="#">https://www.travel.com/booking-details</a>
                        </div>
                        <div class="booking-border d-flex">
                            {{-- <a href="#" class="nir-btn me-2"><i class="fa fa-print"></i> Print</a> --}}
                            {{-- @if ($orders->status_pembayaran == 'pending')
                            <a id="pay-button" href="/api/payment_handler" class="nir-btn me-2" onclick="pay(event)"><i
                                    class="fa fa-dollar"></i>
                                Pay!</a>
                            @else
                            <a href="/cetak" id="pay-button" type="submit" class="nir-btn me-2" onclick="cetak(event)">
                                <i class="fa fa-print"></i> cetak
                            </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-xs-12 mb-4 ps-4">
                <div class="sidebar-sticky">
                    <div class="list-sidebar">
                        <div class="sidebar-item bordernone bg-white rounded box-shadow overflow-hidden p-3 mb-4">
                            <h4>Need Booking Help?</h4>
                            <div class="sidebar-module-inner">
                                <p class="mb-2">Paid was hill sir high 24/7. For him precaution any advantages
                                    dissimilar.</p>
                                <ul class="help-list">
                                    <li class="border-b pb-1 mb-1"><span class="font-weight-bold">Hotline</span>: +475
                                        15 123 21</li>
                                    <li class="border-b pb-1 mb-1"><span class="font-weight-bold">Email</span>:
                                        support@Yatriiworld.com</li>
                                    <li><span class="font-weight-bold">Livechat</span>: Yatriiworld (Skype)</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-item bg-white rounded box-shadow overflow-hidden p-3 mb-4">
                            <h4>Why booking with us?</h4>
                            <div class="sidebar-module-inner">
                                <ul class="featured-list-sm">
                                    <li class="border-b pb-2 mb-2">
                                        <h6 class="mb-0">No Booking Charges</h6>
                                        We don't charge you an extra fee for booking a hotel room with us
                                    </li>
                                    <li class="border-b pb-2 mb-2">
                                        <h6 class="mb-0">No Cancellation Fees</h6>
                                        We don't charge you a cancellation or modification fee in case plans change
                                    </li>
                                    <li class="border-b pb-2 mb-2">
                                        <h6 class="mb-0">Instant Confirmation</h6>
                                        Instant booking confirmation whether booking online or via the telephone
                                    </li>
                                    <li>
                                        <h6 class="mb-0">Flexible Booking</h6>
                                        You can book up to a whole year in advance or right up until the moment of your
                                        stay
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- top Destination ends -->

<!-- Discount action starts -->

<!-- partner ends -->
@endsection

@push('bawah')
<script>
    function cetak(event) {
        event.preventDefault();
        window.print();
    }
</script>
@endpush
{{-- <script>
    function submitForm(event) {
                event.preventDefault();
                document.querySelector('form').submit();
            }
</script> --}}