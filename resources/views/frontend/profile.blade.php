@extends('frontend.layouts.mainds')

@push('style-alt')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@endpush
@section('content')
<div class="col">
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">User Profile</h4>
            @if(isset($profile))
            <form method="POST" action="{{ route('profup.profup', $profile->id) }}" id="update-profile-form">
                @method('PUT')
                @else
                <form method="POST" action="{{ route('profile.profilebaru') }}" id="update-profile-form">
                    @endif
                    @csrf
                    <div class="row">
                        @if(isset($profile) && isset($profile->photo))
                        <img id="profile-image" src="{{ asset('storage/photos/'.$profile->photo) }}" alt="Profile Image"
                            style="max-width: 200px; max-height: 200px;">
                        @endif
                        <div class="col-lg-12 mb-3">
                            <label for="upload" class="form-label">User Image</label>
                            <input class="form-control" type="file" id="img" name="img"
                                value="{{ isset($profile) ? $profile->photo : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off"
                                placeholder="" value="{{ isset($profile) ? $profile->nama : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" autocomplete="off"
                                placeholder="" value="{{ isset($profile) ? $profile->nik : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phoneno" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" id="jk" name="jk" autocomplete="off" placeholder=""
                                value="{{ isset($profile) ? $profile->jk : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="username" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" autocomplete="off"
                                placeholder="" value="{{ isset($profile) ? $profile->address : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="password" class="form-label">No Telephone</label>
                            <input type="text" class="form-control" id="no_tlp" name="no_tlp" autocomplete="off"
                                placeholder="" value="{{ isset($profile) ? $profile->no_tlp : '' }}">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="password" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" autocomplete="off"
                                placeholder="" value="{{ isset($profile) ? $profile->email : '' }}">
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary" onclick="prof(event)">
                                <i class="link-icon" data-feather="{{ isset($profile) ? 'edit' : 'plus' }}"></i>
                                {{ isset($profile) ? 'Update' : 'Create' }} Profile
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection

@push('bawah')
{{-- <script>
    function submitForm(event) {
    event.preventDefault();
    
    // Tambahkan SweetAlert di sini
    Swal.fire({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    },
    icon: 'success',
    title: 'Success',
    text: 'Profile has been ' + ({{ isset($profile) ? "'updated'" : "'created'" }}) + ' successfully'
    });
    
    document.querySelector('#update-profile-form').submit();
    }
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function prof(event) {
        event.preventDefault();
        document.querySelector('#update-profile-form').submit();
    }
</script>
@endpush