@extends('backend.layout.main')
@push('style-alt')
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
<!-- End plugin css for this page -->
@endpush
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Receptionist</a></li>
        <li class="breadcrumb-item active" aria-current="page">Booking</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="container-fluid d-flex justify-content-between">
                    @php
                    $g = request()
                    ->session()
                    ->get('gus');
                    @endphp
                    <div class="col-lg-3 ps-0">
                        <a href="#" class="noble-ui-logo d-block mt-3">Mitra<span>HOTEL</span></a>
                        <p>Jl. Ahmad Yani,<br> No 62, Kavling 06<br>Kendari, Sulawesi Tenggara.</p>
                        <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                        <p>{{ $g['name'] }},<br> {{ $g['email'] }},<br> {{ $g['no_tlp'] }}.</p>
                    </div>
                    <div class="col-lg-3 pe-0">
                        <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
                        <h6 class="text-end mb-5 pb-4"># INV-002308</h6>
                        <p class="text-end mb-1">Balance Due</p>
                        <h4 class="text-end fw-normal">{{'Rp.'.number_format($g['total']) }}</h4>
                        <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date :</span>
                            {{ $g['check_in'] }}</h6>
                        <h6 class="text-end fw-normal"><span class="text-muted">Due Date :</span> {{ $g['check_out'] }}
                        </h6>
                    </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                    <div class="table-responsive w-100">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Deskripsi</th>
                                    <th class="text-end">Unit cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-end">

                                    <td class="text-start">{{ $g['name_room']->room }}</td>
                                    <td>{{'Rp. ' . number_format($g['name_room']->harga) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th class="text-end">Unit cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-end">
                                    <td class="text-start">{{ $g['check_in'] }}</td>
                                    <td>{{$g['check_out'] }}</td>
                                    <td>{{'Rp. ' . number_format($g['kmrtot']) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fasilitas Tambahan</th>
                                    <th class="text-end">Unit cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($g['fasilitas_id'] as $item)
                                @foreach ($item['data'] as $key)
                                <tr class="text-end">
                                    <td class="text-start">
                                        {{ $key['fasilitas'] }}
                                    </td>
                                    <td>{{'Rp. ' . number_format($key['harga']) }}</td>
                                </tr>
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                    <div class="row">
                        <div class="col-md-6 ms-auto">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr class="bg-light">
                                            <td class="text-bold-800">Sub Total</td>
                                            <td class="text-bold-800 text-end">{{'Rp. ' . number_format($g['total']) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form action="{{route('booking.store')}}" method="POST">
                            @csrf
                            <button type="submit" id="saveBtn" value="create" class="btn btn-primary">Add
                                Booking</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
@push('script-alt')
<!-- Plugin js for this page -->
<script src="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- Plugin js for this page -->
<script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<!-- End plugin js for this page -->

<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
<!-- End custom js for this page -->

<!-- Custom js for this page -->
<script src="{{ asset('backend/assets/js/sweet-alert.js') }}"></script>
<!-- End custom js for this page -->
@endpush