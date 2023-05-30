<!-- Preloader -->
<div id="preloader">
    <div id="status"></div>

</div>
<!-- Preloader Ends -->
<!-- header starts -->
<header class="main_header_area">
    <div class="header-content py-1 bg-theme">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="links">
                <ul>
                    <li><a href="#" class="white"><i class="icon-calendar white"></i> {{ now()->format('l, d F Y')
                            }}</a></li>
                    <li><a href="#" class="white"><i class="icon-location-pin white"></i> Hollywood, America</a></li>
                    <li><a href="#" class="white"><i class="icon-clock white"></i> {{ now()->format('H:i:s') }}</a></li>
                </ul>
            </div>
            <div class="links float-right">
                <ul>
                    <li><a href="#" class="white"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="white"><i class="fab fa-linkedin " aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Navigation Bar -->
    <div class="header_menu" id="header_menu">
        <nav class="navbar navbar-default">
            @auth
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-3 pt-3">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="image">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="responsive-menu">
                            <li class="dropdown submenu active">
                                <a href="{{ route('duser.index') }}" class="dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Home <i
                                        aria-hidden="true"></i></a>
                            </li>
                            <li><a href="/profile">About Us</a></li>
                            <li class="submenu dropdown">
                                <a href="/mybooking" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">My Booking <i aria-hidden="true"></i></a>
                            </li>
                            <li class="submenu dropdown">
                                <a href="/profile" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Profile <i aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="me-3" onclick="submit(event)">
                                        <i class="icon-user"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div><!-- /.navbar-collapse -->


                    <div id="slicknav-mobile"></div>
                </div>
            </div><!-- /.container-fluid -->
            @endauth
        </nav>
        <nav class="navbar navbar-default">
            @guest
            <div class="container">
                <div class="navbar-flex d-flex align-items-center justify-content-between w-100 pb-3 pt-3">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="image">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="navbar-collapse1 d-flex align-items-center" id="bs-example-navbar-collapse-1">
                        <div class="register-login d-flex align-items-center">
                            <a href="/login" class="nir-btn white">
                                <i class="icon-user"></i> Login/Register
                            </a>
                        </div>
                    </div><!-- /.navbar-collapse -->
                    <div id="slicknav-mobile"></div>
                </div>
            </div><!-- /.container-fluid -->
            @endguest
        </nav>
    </div>
    <!-- Navigation Bar Ends -->
</header>
<!-- header ends -->
<!-- login registration modal -->
<div class="modal fade log-reg" id="login-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="post-tabs">
                    <!-- tab navs -->
                    <ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button aria-controls="login" aria-selected="false" class="nav-link active"
                                data-bs-target="#login" data-bs-toggle="tab" id="login-tab" role="tab"
                                type="button">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button aria-controls="register" aria-selected="true" class="nav-link"
                                data-bs-target="#register" data-bs-toggle="tab" id="register-tab" role="tab"
                                type="button">Register</button>
                        </li>
                    </ul>
                    <!-- tab contents -->
                    <div class="tab-content blog-full" id="postsTabContent">
                        <!-- popular posts -->
                        <div aria-labelledby="login-tab" class="tab-pane fade active show" id="login" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-image rounded">
                                        <a href="#" style="background-image: url(images/trending/trending5.jpg);"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-center border-b pb-2">Login</h4>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <input type="email" class="form-control" id="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="username"
                                                placeholder="Email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-group mb-2">
                                            <input type="password" name="password" class="form-control" id="password"
                                                autocomplete="current-password" placeholder="Password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="comment-btn mb-2 pb-2 text-center border-b">
                                            <button type="submit" class="nir-btn w-100" style="margin-top: 23px"
                                                onclick="log(event)">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Recent posts -->
                        <div aria-labelledby="register-tab" class="tab-pane fade" id="register" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="blog-image rounded">
                                        <a href="#" style="background-image: url(images/trending/trending5.jpg);"></a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-center border-b pb-2">Register</h4>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group mb-2">
                                            <input id="name" class="form-control" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name"
                                                placeholder="User Name">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="form-group mb-2">
                                            <input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autocomplete="username"
                                                placeholder="Email">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-group mb-2">
                                            <input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="new-password" placeholder="Password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="form-group mb-2">
                                            <input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password"
                                                placeholder="Confirm Password">
                                            <x-input-error :messages="$errors->get('password_confirmation')"
                                                class="mt-2" />
                                        </div>
                                        <div class="comment-btn mb-2 pb-2 text-center border-b">
                                            <button class="nir-btn w-100" style="margin-top: 23px"
                                                onclick="register(event)">Sign Up</button>
                                        </div>
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

<script>
    function log(event) {
                event.preventDefault();
                document.querySelector('form').submit();
            }
   function register(event) {
event.preventDefault();
document.querySelector('form').submit();
}
</script>