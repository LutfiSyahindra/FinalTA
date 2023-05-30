@php
$terisi = \App\Models\Visibility::whereNotNull('check_in')
->whereNotNull('check_out')
->count();
$kosong = \App\Models\Visibility::whereNull('check_in')
->whereNull('check_out')
->count();
$reservasi = \App\Models\Guest::where('status', 'reservasi')->count();
$tamu = \App\Models\Guest::latest()
->limit(10)
->get();
@endphp

@extends('backend.layout.main')
@section('content')
<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Kamar Kosong</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2" style="margin-top: 10px; font-size: 30px;">{{ $kosong }}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text" style="font-size: 12px; color: #0d6efd">
                                        <span>{{ $kosong }} Kamar Kosong</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                                <i class="fa fa-bed fa-5x" style="margin-left: 50px; color: #0d6efd "
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Kamar Terisi</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2" style="margin-top: 10px; font-size: 30px;">{{ $terisi }}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text" style="font-size: 12px; color: red">
                                        <span> {{ $terisi }} Kamar Terisi</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                                <i class="fa fa-bed fa-5x" style="margin-left: 50px; color: red "
                                    aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0">Reservasi</h6>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2" style="margin-top: 10px; font-size: 30px;">{{ $reservasi }}</h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text" style="font-size: 12px; color: gray">
                                        <span> {{ $reservasi }} Reservasi</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                                <i class="fa fa-handshake-o fa-5x" aria-hidden="true"
                                    style="margin-left: 50px; color: darkslategrey "></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->

{{-- <div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">Revenue</h6>
                    <div class="dropdown">
                        <a type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                    class="icon-sm me-2"></i> <span class="">View</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-start">
                    <div class="col-md-7">
                        <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business
                            has from its normal business activities, usually from the sale of goods and
                            services to customers.</p>
                    </div>
                    <div class="col-md-5 d-flex justify-content-md-end">
                        <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-primary">Today</button>
                            <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                            <button type="button" class="btn btn-primary">Month</button>
                            <button type="button" class="btn btn-outline-primary">Year</button>
                        </div>
                    </div>
                </div>
                <div id="revenueChart"></div>
            </div>
        </div>
    </div>
</div> <!-- row --> --}}

{{-- <div class="row">
    <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Monthly sales</h6>
                    <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                    class="icon-sm me-2"></i> <span class="">View</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                        </div>
                    </div>
                </div>
                <p class="text-muted">Sales are activities related to selling or the number of goods or
                    services sold in a given time period.</p>
                <div id="monthlySalesChart"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                    <h6 class="card-title mb-0">Cloud storage</h6>
                    <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                    class="icon-sm me-2"></i> <span class="">View</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                        </div>
                    </div>
                </div>
                <div id="storageChart"></div>
                <div class="row mb-3">
                    <div class="col-6 d-flex justify-content-end">
                        <div>
                            <label
                                class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">Total
                                storage <span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
                            <h5 class="fw-bolder mb-0 text-end">8TB</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span
                                    class="p-1 me-1 rounded-circle bg-primary"></span> Used
                                storage</label>
                            <h5 class="fw-bolder mb-0">~5TB</h5>
                        </div>
                    </div>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary">Upgrade storage</button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row --> --}}

<div class="row">
    <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Daftar Tamu</h6>
                    {{-- <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye"
                                    class="icon-sm me-2"></i> <span class="">View</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i
                                    data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                        </div>
                    </div> --}}
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="pt-0">No</th>
                                <th class="pt-0">Name</th>
                                <th class="pt-0">Check-In</th>
                                <th class="pt-0">Check-out</th>
                                {{-- <th class="pt-0">Status</th> --}}
                                <th class="pt-0">Kamar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tamu as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->check_in }}</td>
                                <td>{{ $item->check_in }}</td>
                                {{-- <td><span class="badge bg-danger">Released</span></td> --}}
                                <td>{{$item->Room->room}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->
@endsection