<!-- footer starts -->
<footer class="pt-20 pb-4" style="background-image: url({{ asset('frontend/images/background_pattern.png') }});">
    <div class="section-shape top-0" style="background-image: url({{ asset('frontend/images/shape8.png') }});"></div>


    <div class="footer-payment">
        <div class="container">
            <div class="row footer-pay align-items-center justify-content-between text-lg-start text-center">
                <div class="col-lg-8 footer-payment-nav mb-4">
                    <ul class="">
                        <li class="me-2">We Support:</li>
                        <li class="me-2"><i class="fab fa-cc-mastercard fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-paypal fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-stripe fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-visa fs-4"></i></li>
                        <li class="me-2"><i class="fab fa-cc-discover fs-4"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <div class="container">
            <div class="copyright-inner rounded p-3 d-md-flex align-items-center justify-content-between">
                <div class="copyright-text">
                    <p class="m-0 white">2022 Travelin. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="particles-js"></div>
</footer>
<!-- footer ends -->

<!-- *Scripts* -->
<script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/particles.js') }}"></script>
<script src="{{ asset('frontend/js/particlerun.js') }}"></script>
<script src="{{ asset('frontend/js/plugin.js') }}"></script>
<script src="{{ asset('frontend/js/main.js') }}"></script>
<script src="{{ asset('frontend/js/custom-swiper.js') }}"></script>
<script src="{{ asset('frontend/js/custom-nav.js') }}"></script>
@stack('bawah')