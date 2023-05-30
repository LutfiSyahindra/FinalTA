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
        <li class="breadcrumb-item active" aria-current="page">Cari Kamar</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Cari Kamar</h6>
                <form action="{{ route('cekKamar.cekKamar') }}" method="POST">
                    @csrf
                    <div class="row pb-3">
                        <div class="col-md-5">
                            <label class="form-label">Check-In</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="check_in" name="check_in">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Check-Out</label>
                            <div class="input-group flatpickr" id="flatpickr-date">
                                <input type="text" class="form-control" placeholder="Select date" data-input
                                    id="check_out" name="check_out">
                                <span class="input-group-text input-group-addon" data-toggle><i
                                        data-feather="calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="saveBtn" value="create" class="btn btn-primary"
                                style="margin-top: 28px" onclick="submitForm(event)">
                                filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

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

<script>
    function submitForm(event) {
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
                    text: 'Tanggal check-in harus sama dengan atau setelah hari ini',
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
@endpush