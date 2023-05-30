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
        <li class="breadcrumb-item active" aria-current="page">Daftar Tamu</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Check-in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">History</a>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h6 class="card-title">Daftar Tamu</h6>
                        <div class="table-responsive">
                            <table id="dataTable" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Tamu</th>
                                        {{-- <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No-Tlp</th> --}}
                                        <th>Kamar</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        {{-- <th>Total Harga</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <h6 class="card-title">Daftar Tamu Check-in</h6>
                        <div class="table-responsive">
                            <table id="dataTablecin" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Tamu</th>
                                        {{-- <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No-Tlp</th> --}}
                                        <th>Kamar</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        {{-- <th>Total Harga</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <h6 class="card-title">Daftar Tamu Check-out</h6>
                        <div class="table-responsive">
                            <table id="dataTablecot" class="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Tamu</th>
                                        {{-- <th>NIK</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No-Tlp</th> --}}
                                        <th>Kamar</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        {{-- <th>Total Harga</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="disabled" role="tabpanel" aria-labelledby="disabled-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxModal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <form id="fasilitasForm" name="fasilitasForm" class="form-sample">
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label for="room" class="col-sm-3 col-form-label">Room</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="room" name="room" placeholder="Enter room">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter fasilitas">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Enter Description">
                            </input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jk" name="jk" placeholder="Enter Description">
                            </input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                placeholder="Enter Description">
                            </input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="no_tlp" class="col-sm-3 col-form-label">Nomor Telpon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp"
                                placeholder="Enter Description">
                            </input>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="check_in" class="col-sm-3 col-form-label">Check-in</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="check_in"
                                name="check_in">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="check_out" class="col-sm-3 col-form-label">Check-out</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="check_out"
                                name="check_out">
                        </div>
                    </div>
                    <div class="modal-footer" id="button">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" value="create" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
{{-- <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                            <a href="#" class="noble-ui-logo d-block mt-3">Hotel<span>Mitra</span></a>
                            <p class="mt-1 mb-1"><b>MitraHotels</b></p>
                            <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p>
                            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                            <p id="nama"></p>
                        </div>
                        <div class="col-lg-3 pe-0">
                            <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
                            <h6 class="text-end mb-5 pb-4"># INV-002308</h6>
                            <p class="text-end mb-1">Balance Due</p>
                            <h4 class="text-end fw-normal" id="balanced"></h4>
                            <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Invoice Date:</span>
                                <span id="date1"></span>
                            </h6>
                            <h6 class="text-end fw-normal"><span class="text-muted">Due Date:</span> <span
                                    id="date2"></span></h6>
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
                                        <td class="text-start" id="kamar"></td>
                                        <td class="text-end" id="harga"></td>
                                    </tr>
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
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-end">$ 14,900.00</td>
                                            </tr>
                                            <tr>
                                                <td>TAX (12%)</td>
                                                <td class="text-end">$ 1,788.00</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold-800">Total</td>
                                                <td class="text-bold-800 text-end"> $ 16,688.00</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Made</td>
                                                <td class="text-danger text-end">(-) $ 4,688.00</td>
                                            </tr>
                                            <tr class="bg-light">
                                                <td class="text-bold-800">Balance Due</td>
                                                <td class="text-bold-800 text-end">$ 12,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid w-100">
                        <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send"
                                class="me-3 icon-md"></i>Send Invoice</a>
                        <a href="javascript:;" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer"
                                class="me-2 icon-md"></i>Print</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


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

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Rendering Table

        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('daftartamu.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        var table = $('#dataTablecin').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cin.checkin') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        var table = $('#dataTablecot').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cot.checkout') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
       
    $('body').on('click', '.show-tamu', function() {
        document.getElementById('button').style.visibility = 'hidden';
        var id = $(this).data('id');
        $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(
        data) {
            $('#modelHeading').html("DETAIL DATA TAMU");
            $('#ajaxModal').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name).attr('disabled', true);
            $('#room').val(data.room_id).attr('disabled', true);
            $('#nik').val(data.nik).attr('disabled', true);
            $('#no_tlp').val(data.no_tlp).attr('disabled', true);
            $('#jk').val(data.jk).attr('disabled', true);
            $('#alamat').val(data.address).attr('disabled', true);
            $('#check_in').val(data.check_in).attr('disabled', true);
            $('#check_out').val(data.check_out).attr('disabled', true);
            attr('disabled', true);
         })
    });
    
    $('body').on('click', '.show-invoice', function() {
    $('#button').css('visibility', 'hidden');
    var id = $(this).data('id');
    $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(data) {
        $('#modelHeading').html("DETAIL DATA TAMU");
        $('#invoiceModal').modal('show');
        $('#id').val(data.id);
        // $('#nama').html(data.name + ',<br>' + data.no_tlp);
        // $('#date1').html(moment(data.check_in).format('DD MMMM YYYY'));
        // $('#date2').html(moment(data.check_out).format('DD MMMM YYYY'));
        // $('#balanced').html('Rp ' + new Intl.NumberFormat('id-ID').format(data.total));
        // $('#kamar').html(data.room_id.room);
        // $('#harga').html('Rp ' + new Intl.NumberFormat('id-ID').format(data.room_id.harga));

        
    })
});
    // $('body').on('click', '.show-tamu', function() {
    //     document.getElementById('gambar').style.visibility = 'hidden';
    //     document.getElementById('button').style.visibility = 'hidden';
    //     var id = $(this).data('id');
    //     $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(
    //     data) {
    //         $('#modelHeading').html("DETAIL DATA ROOM");
    //         $('#ajaxModal').modal('show');
    //         $('#id').val(data.id);
    //         $('#room').val(data.room).attr('disabled', true);
    //         $('#deskripsi').val(data.deskripsi).attr('disabled', true);
    //         $('#harga').val(data.harga).
    //         attr('disabled', true);
    //         if (data.img) {
    //             var url = `backend/assets/images/room/${data.img}`;
    //             $('#image_preview').attr('src', url);
    //             // $("#avatar").html(
    //             // `<img src="storage/uploads/img/${data.img_pelatih}" width="100" class="img-fluid img-thumbnail">`
    //             // );
    //             console.log(data);
    //         }
    //     })
    // });
        // Arsipkan Data
       // Arsipkan Data
        $('body').on('click', '#delete-tamu', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'me-2',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                        var id = $(this).data("id");
                        $.ajax({
                            type: "DELETE",
                            url: 'daftartamu/' + id,
                            data: id,
                            success: function(response) {
                                swalWithBootstrapButtons.fire(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        table.draw();
                                        location.reload(true);
                                    });
                                }
                            });
                    } else {
                        Swal.fire("Cancel!", "Perintah dibatalkan!", "error");
                    }
                });
        });
    });

    function openInvoiceModal(id) {
    $.ajax({
        type: "GET",
        url: "/invoices/" + id,
        success: function (data) {
            $("#invoiceModal").modal("show");
            $("#modelHeading").html("Invoice #" + data.id);
            $("#name").html(data.customer_name);
            // Isi data lainnya sesuai dengan struktur modal invoice
            // ...
        },
        error: function (data) {
            console.log("Error:", data);
        }
    });
}
</script>
{{-- <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Rendering Table

        var table = $('#dataTablecin').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cin.checkin') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
       
       $('body').on('click', '.edit-tamu', function() {
        // document.getElementById('pass').style.visibility = 'hidden';
        var id = $(this).data('id');
        $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(
        data) {
        console.log(data)
        $('#modelHeading').html("EDIT DATA KARYAWAN");
        $('#saveBtn').val("edit-user");
        $('#ajaxModal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#password').val(data.password);
        $('#role').val(data.roles);
        })
        });

        // Arsipkan Data
       // Arsipkan Data
        $('body').on('click', '#delete-tamu', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'me-2',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                        var id = $(this).data("id");
                        $.ajax({
                            type: "DELETE",
                            url: 'daftartamu/' + id,
                            data: id,
                            success: function(response) {
                                swalWithBootstrapButtons.fire(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        table.draw();
                                        location.reload(true);
                                    });
                                }
                            });
                    } else {
                        Swal.fire("Cancel!", "Perintah dibatalkan!", "error");
                    }
                });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Rendering Table

        var table = $('#dataTablecot').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('cot.checkout') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Nama Tamu',
                    name: 'Nama Tamu'
                },
                // {
                //     data: 'NIK',
                //     name: 'NIK'
                // },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                {
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'Check-in',
                    name: 'Check-in'
                },
                {
                    data: 'Check-out',
                    name: 'Check-out'
                },
                // {
                //     data: 'harga',
                //     name: 'harga'
                // },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
       
       $('body').on('click', '.edit-tamu', function() {
        // document.getElementById('pass').style.visibility = 'hidden';
        var id = $(this).data('id');
        $.get("{{ route('daftartamu.index') }}" + '/' + id + '/edit', function(
        data) {
        console.log(data)
        $('#modelHeading').html("EDIT DATA KARYAWAN");
        $('#saveBtn').val("edit-user");
        $('#ajaxModal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#email').val(data.email);
        $('#password').val(data.password);
        $('#role').val(data.roles);
        })
        });

        // Arsipkan Data
       // Arsipkan Data
        $('body').on('click', '#delete-tamu', function() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger me-2'
                },
                buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'me-2',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                })
                .then((result) => {
                    if (result.value) {
                        var id = $(this).data("id");
                        $.ajax({
                            type: "DELETE",
                            url: 'daftartamu/' + id,
                            data: id,
                            success: function(response) {
                                swalWithBootstrapButtons.fire(response.status, {
                                        icon: "success",
                                    })
                                    .then((result) => {
                                        table.draw();
                                    });
                            }
                        });
                    } else {
                        Swal.fire("Cancel!", "Perintah dibatalkan!", "error");
                    }
                });
        });
    });
</script> --}}