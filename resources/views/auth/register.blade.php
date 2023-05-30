@include('backend.layout.head')
<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">

                                </div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="#" class="noble-ui-logo d-block mb-2">Mitra<span>HOTEL</span></a>
                                    <h5 class="text-muted fw-normal mb-4">Create account.</h5>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" :value="__('Name')"" class=" form-label">Username</label>
                                            <input id="name" class="form-control" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" :value="__('Email')">Email address</label>
                                            <input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autocomplete="username">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" :value="__('Password')">Password</label>
                                            <input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" :value="__('Confirm Password')">Confirm
                                                Password</label>
                                            <input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password_confirmation')"
                                                class="mt-2" />
                                        </div>
                                        <div>
                                            <button class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign
                                                up</button>
                                        </div>
                                        <a href="{{ route('login') }}" class="d-block mt-3 text-muted">Already a user?
                                            Sign in</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>