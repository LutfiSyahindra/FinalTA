@extends('backend.layout.main')
@push('style-alt')
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
<!-- Plugin css for this page -->
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/sweetalert2/sweetalert2.min.css') }}">
<!-- End plugin css for this page -->
@endpush
@section('content')
<form action="{{ route('pdf') }}" method="get">
    <div class="form-group">
        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control">
    </div>
    <div class="form-group">
        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Generate PDF</button>
</form>
<h1>Cash Opname</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Income</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $item->created_at }}</td>
            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>
@endsection