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
        <li class="breadcrumb-item active" aria-current="page">Cash Opname</li>
    </ol>
</nav>

<!-- Modal -->
<div class="modal fade" id="opname" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelHeading">Tambah Cash Opname</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" style="display: none;"></div>
                <form method="POST" action="/store" id="opname">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="row mb-3">
                        <label for="fasilitas" class="col-sm-3 col-form-label">Start Date</label>
                        <div class="input-group flatpickr" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="start_date"
                                name="start_date">
                            <span class="input-group-text input-group-addon" data-toggle><i
                                    data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="fasilitas" class="col-sm-3 col-form-label">End Date</label>
                        <div class="input-group flatpickr col-sm-9" id="flatpickr-date">
                            <input type="text" class="form-control" placeholder="Select date" data-input id="end_date"
                                name="end_date">
                            <span class="input-group-text input-group-addon" data-toggle><i
                                    data-feather="calendar"></i></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div>
                            <label class="form-label">Date time:</label>
                            <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'"
                                data-inputmask-inputformat="dd/mm/yyyy HH:MM:ss" />
                        </div>
                    </div>
                   
                    <div class="row mb-3">
                        <label for="total_income" class="col-sm-3 col-form-label">income</label>
                        <div>
                            <input type="text" class="form-control" id="total_income" name="total_income"
                                placeholder="Enter Price" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="open" class="col-sm-6 col-form-label">Opening Balanced</label>
                        <div>
                            <input type="number" class="form-control" id="open" name="open"
                                placeholder="Enter Opening Balanced">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="open" class="col-sm-3 col-form-label">Total Cash</label>
                        <div>
                            <input type="text" class="form-control" id="cash" name="cash"
                                placeholder="Enter Opening Balanced" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="kas" class="col-sm-3 col-form-label">Jumlah Kas</label>
                        <div>
                            <input type="text" class="form-control" id="kas" name="kas" placeholder="Enter Price">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="rekon" class="col-sm-3 col-form-label">Rekonsiliasi</label>
                        <div>
                            <input type="text" class="form-control" id="rekon" name="rekon"
                                placeholder="Enter Rekonsiliasi">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="rekon" class="col-sm-5 col-form-label">Alasan Rekonsiliasi</label>
                        <div>
                            <input type="text" class="form-control" id="alasan" name="alasan" placeholder="">
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

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#opname">
                    Tambah Cash Opname
                </button>
                <div class="table-responsive">
                    <table id="dataTable" class="table" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode Awal</th>
                                <th>Periode Akhir</th>
                                {{-- <th>Deskripsi</th>
                                <th>Gambar</th> --}}
                                <th>Action</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->start_date }} s/d {{ $item->end_date }}</td>
                                <td>
                                    <button id="detail">detail</button>
                                </td>
                            </tr>
                            @endforeach --}}
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
            ajax: "{{ route('opname.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'Periode Awal',
                    name: 'Periode Awal'
                },
                {
                    data: 'Periode Akhir',
                    name: 'Periode Akhir'
                },
                // {
                //     data: 'Jenis Kelamin',
                //     name: 'Jenis Kelamin'
                // },
                // {
                //     data: 'No-Telp',
                //     name: 'No-Telp'
                // },
                // {
                //     data: 'kamar',
                //     name: 'kamar'
                // },
                // {
                //     data: 'Check-in',
                //     name: 'Check-in'
                // },
                // {
                //     data: 'Check-out',
                //     name: 'Check-out'
                // },
                // // {
                // //     data: 'harga',
                // //     name: 'harga'
                // // },
                // {
                //     data: 'status',
                //     name: 'status'
                // },
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
        $.get("{{ route('opname.index') }}" + '/' + id + '/edit', function(
        data) {
            $('#modelHeading').html("DETAIL DATA CASH OPNAME");
            $('#opname').modal('show');
            $('#id').val(data.id);
            $('#start_date').val(data.start_date).attr('disabled', true);
            $('#end_date').val(data.end_date).attr('disabled', true);
            $('#total_income').val(data.total_income).attr('disabled', true);
            $('#open').val(data.open).attr('disabled', true);
            $('#cash').val(data.total).attr('disabled', true);
            $('#kas').val(data.jml_kas).attr('disabled', true);
            $('#rekon').val(data.rekonsiliasi).attr('disabled', true);
            $('#alasan').val(data.alasan).attr('disabled', true);
            attr('disabled', true);
         })
    });
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
    // Fungsi untuk mengambil total income dari server
    function income() {
    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();
   
    
    $.ajax({
    type: 'POST',
    url: '/income',
    data: {
    start_date: start_date,
    end_date: end_date,
    _token: '{{ csrf_token() }}'
    },
    success: function(response) {

        
        var total_income = response.total_income;
        var hasil = response.hasil;
        
        $('#total_income').val("Rp " + total_income.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }));

        $('#open').on('input', function() {
        var open = $(this).val().replace(/\D/g, '');
        var total_income = $('#total_income').val().replace(/\D/g, '');
        var totalCash = parseInt(open) + parseInt(total_income);
        
        $('#cash').val("Rp "+totalCash.toLocaleString('id-ID', { currency: 'IDR' }));
        });
    },
    error: function(xhr, textStatus, errorThrown) {
    console.log(xhr.responseText);
    }
    });
    }
    
    // Fungsi untuk mengikat event pada form
    function bindFormEvents() {
    // Event untuk mengambil total income saat tanggal berubah
    $('#start_date, #end_date').on('change', function() {
    income();
    });
    }
    
    // Jalankan fungsi bindFormEvents pada saat halaman dimuat
    $(document).ready(function() {
    bindFormEvents();
    });

    const pickerInline = document.querySelector('.timepicker-inline-24');
    const timepickerMaxMin = new mdb.Timepicker(pickerInline, { format24:true, inline: true });
</script>