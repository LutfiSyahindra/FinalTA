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
        <li class="breadcrumb-item active" aria-current="page">Penjualan Kamar</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Penjualan Kamar</h6>
                <form action="/filter" method="get">
                    <div class="row pb-3">
                        <div class="col-md-5">
                            <label class="form-label">Start Date</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="start_date" name="start_date">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">End Date</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="end_date" name="end_date">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="saveBtn" value="create" class="btn btn-primary"
                                style="margin-top: 28px">
                                filter</button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="dataTable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kamar</th>
                                {{-- <th>Deskripsi</th>
                                <th>Gambar</th> --}}
                                <th>Jumlah Terjual</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->room->room }}</td>
                                <td>{{ $item->jumlah }}  Kamar</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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