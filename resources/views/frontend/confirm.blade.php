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
                <h1 class="mb-3">Confirm</h1>
                <nav aria-label="breadcrumb" class="d-block">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Confirm</li>
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
                        <form method="POST" action="/pay" id="update-profile-form">
                            @csrf
                            <input type="hidden" name="json" id="json_callback">
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
                            <div class="travellers-info mb-4">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>kamar</th>
                                            <th>Check-In</th>
                                            <th>Check-Out</th>
                                            <th>Harga</th>
                                            <th>Payment Method</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="theme2">{{ $bookingNumber }}</td>
                                            <td class="theme2" value="room_id">{{ $data['room'] }}</td>
                                            <td class="theme2">{{ $data['checkIn'] }}</td>
                                            <td class="theme2">{{ $data['checkOut'] }}</td>
                                            <td class="theme2">Rp {{ number_format($data['totalkamar'], 0, ',', '.') }}
                                            </td>
                                            {{-- <td>Rp {{ number_format($hargakmr, 0, ',', '.') }}</td> --}}
                                            <td class="theme2">Cashless</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="travellers-info mb-4">
                                <h4>Bill Information</h4>
                                <table>
                                    @foreach ($fasilitas as $facility)
                                    <tr>
                                        <td>
                                            {{ $facility['data']['fasilitas'] }}
                                        </td>
                                        <td>
                                            Rp {{
                                            number_format($facility['data']['harga'], 0, ',',
                                            '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td style="color: black; font-weight: bold;">Grand Total</td>
                                        <td style="color: black; font-weight: bold;">Rp {{
                                            number_format($data['kmrtot'], 0,
                                            ',',
                                            '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="travellers-info mb-4">
                                <h4>Guest Information</h4>
                                <table>
                                    <tr>
                                        <td>Booking Number</td>
                                        <td>5784-BD245</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data['nama'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIK</td>
                                        <td>{{ $data['nik'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ $data['jk'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telephone</td>
                                        <td>{{ $data['tlp'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email Address</td>
                                        <td>{{ $data['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $data['address'] }}</td>
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
                                {{-- <button type="submit" class="nir-btn me-2" onclick="submitForm(event)"><i
                                        class="fa fa-print"></i> Selesai</button> --}}
                                <button id="pay-button" type="submit" class="nir-btn me-2" onclick="pay(event)"
                                    onclick="closeSnap()"><i class="fa fa-dollar"></i> Pay!</button>
                            </div>
                        </form>
                        {{-- @dd($snapToken) --}}
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
<script type="text/javascript">
    function pay(event) {
    event.preventDefault();
    // For example trigger on button clicked, or any time you need
              var payButton = document.getElementById('pay-button');
              console.log(payButton)
              payButton.addEventListener('click', function () {
                // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                window.snap.pay('{{ $snapToken }}', {
                  onSuccess: function(result){
                    /* You may add your own implementation here */
                    alert("payment success!"); console.log(result);
                    send_response_to_form(result);
                    closeSnap();
                  },
                  onPending: function(result){
                    /* You may add your own implementation here */
                    alert("wating your payment!"); console.log(result);
                    send_response_to_form(result);
                    document.querySelector('#update-profile-form').submit();
                    closeSnap();
                  },
                  onError: function(result){
                    /* You may add your own implementation here */
                    alert("payment failed!"); console.log(result);
                    send_response_to_form(result);
                    closeSnap();
                  },
                  onClose: function(){
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                    closeSnap();
                    send_response_to_form(result);
                    // document.querySelector('#update-profile-form').submit();
                  }
                })
              });
            }

            function closeSnap() {
            if (typeof snap !== 'undefined' && snap.isPopupVisible()) {
            snap.closePopup();
            }
            }

            function send_response_to_form(result) {
            var form = document.getElementById('update-profile-form');
            var jsonInput = document.getElementById('json_callback');
            
            jsonInput.value = JSON.stringify(result);
            form.submit();
            }
</script>
@endpush

<script>
    function submitForm(event) {
                event.preventDefault();
                document.querySelector('form').submit();
            }
</script>