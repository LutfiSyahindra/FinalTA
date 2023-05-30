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
        <li class="breadcrumb-item active" aria-current="page">Pendapatan</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Pendapatan</h6>
                <form method="post" action="/uang">
                    @csrf
                  <div class="row pb-3">
                    <div class="col-md-5">
                        <label class="form-label">Start Date</label>
                        <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="start_date"
                                name="start_date">
                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">End Date</label>
                        <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="end_date" name="end_date">
                            <span class="input-group-text input-group-addon" data-toggle><i data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" id="saveBtn" value="create" class="btn btn-primary" style="margin-top: 28px">
                            filter</button>
                    </div>
                </div>
                    {{-- <div class="col-md-5">
                        <label class="form-label">Pilih Tanggal Tertentu</label>
                        <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input
                                id="specific_date" name="specific_date">
                            <span class="input-group-text input-group-addon" data-toggle><i
                                    data-feather="calendar"></i></span>
                        </div>
                    </div> --}}
                </form>
                {{-- <form action="/uang1" method="get">
                    <div class="row pb-3">
                        <div class="col-md-5">
                            <label for="form-label">Start Time</label>
                            <div class="input-group flatpickr" id="flatpickr-time">
                                <label class="form-label">Date time:</label>
                                <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                    data-inputmask-inputformat="dd/mm/yyyy HH:MM:ss" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="form-label">End Time</label>
                            <div class="input-group flatpickr" id="flatpickr-time">
                                <input type="text" class="form-control" placeholder="End Time" id="end_time"
                                    name="end_time" data-input>
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="clock"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="saveBtn" value="create" class="btn btn-primary"
                                style="margin-top: 28px">
                                filter</button>
                        </div>
                    </div>
                </form> --}}

                {{-- <a href="{{ route('pdf.pdf') }}" class="btn btn-success">Cetak Laporan</a> --}}
                <div class="table-responsive">
                    <table id="dataTable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                {{-- <th>Deskripsi</th>
                                <th>Gambar</th> --}}
                                <th>Income</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2" style="background: #D5E0CC;">Total</th>
                                <td style="background: #D5E0CC; font-weight: bold;">Rp {{ number_format($data1) }}</td>
                            </tr>
                        </tfoot>
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