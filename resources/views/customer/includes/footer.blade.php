
<!-- Footer -->
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <a href="index.php">
                    <img src="{{ asset("customerfile/images/logo.png")}}" alt="" style="max-width:100%">
                </a>
                <p>Lorem Ipsum is simply dummy text of printing and type setting industry. Lorem Ipsum been industry standard dummy text ever since, when unknown printer took a galley type scrambled.</p>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6">
                <h4>Useful Links</h4>
                <ul class="utf-footer-links-item">
                    <li><a href="index.html">Home</a>
                    </li>
                    <li><a href="#">About Us</a>
                    </li>
                    <li><a href="#">Services</a>
                    </li>
                    <li><a href="#">Properties</a>
                    </li>
                    <li><a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6">
                <h4>My Account</h4>
                <ul class="utf-footer-links-item">
                    <li><a href="#">Dashboard</a>
                    </li>
                    <li><a href="#">My Profile</a>
                    </li>
                    <li><a href="#">Add Property</a>
                    </li>
                    <li><a href="#">My Listing</a>
                    </li>
                    <li><a href="#">Favorites</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6">
                <h4>Resources</h4>
                <ul class="utf-footer-links-item">
                    <li><a href="#">My Account</a>
                    </li>
                    <li><a href="#">Support</a>
                    </li>
                    <li><a href="#">How It Work</a>
                    </li>
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Term &amp; Condition</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-6">
                <h4>Pages</h4>
                <ul class="utf-footer-links-item">
                    <li><a href="#">Our Partners</a>
                    </li>
                    <li><a href="#">How It Work</a>
                    </li>
                    <li><a href="#">FAQ Page</a>
                    </li>
                    <li><a href="#">Privacy Policy</a>
                    </li>
                    <li><a href="#">Term &amp; Condition</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="copyrights">Copyright © 2020 All Rights Reserved. Oursvib.com Connecting Lifestyle!</div>
            </div>
        </div>
    </div>
</div>
<!-- Footer / End -->

<!-- Back To Top Button -->
<div id="backtotop">
    <a href="#"></a>
</div>
</div>

<!-- Sign In Popup -->
<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item">
            <li class="active"><a href="#login">Log In</a>
            </li>
            <li><a href="#register">Register</a>
            </li>
        </ul>
        <div class="utf-popup-container-part-tabs">
            <!-- Login -->
            <div class="utf-popup-tab-content-item" id="login">
                <div class="utf-welcome-text-item">
                    <h3>Welcome Back Sign in to Continue</h3>
                    <span>Don't Have an Account? <a href="#" class="register-tab">Sign Up!</a></span>
                </div>
                <form method="post" id="login-form">
                    @csrf
                    <div id="errors" class="error"></div>
                    <div class="utf-no-border">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="" value="{{ old('email') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
{{--                    <div class="checkbox margin-top-0">--}}
{{--                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                        <label for="two-step"><span class="checkbox-icon"></span> Remember Me</label>--}}
{{--                    </div>--}}
                    <a href="{{route('password.request')}}" class="forgot-password">Forgot Password?</a>
                    <br>

                <button class="button full-width utf-button-sliding-icon ripple-effect" type="submit" form="login-form">Log In <i class="icon-feather-chevrons-right"></i>
                </button>
                </form>
{{--                <div class="utf-social-login-separator-item"><span>or</span>--}}
{{--                </div>--}}
{{--                <div class="utf-social-login-buttons-block">--}}
{{--                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</button>--}}
{{--                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</button>--}}
{{--                    <button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>--}}
{{--                </div>--}}
            </div>

            <!-- Register -->
            <div class="utf-popup-tab-content-item" id="register">
                <div class="utf-welcome-text-item">
                    <h3>Create your Account!</h3>
                    <span>Already Have an Account? <a href="#" class="login-tab">Sign in!</a></span>
                </div>
                <form method="post" id="register-form" action="{{url('register')}}">
                    <meta name="_token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="utf-no-border margin-bottom-20">
                        <select class="form-control" name="role" id="role">
                            <option value="">Select</option>
                            <option value="2">Vendor</option>
                            <option value="3">Anchor vendor</option>
                            <option value="4">User</option>
                        </select>

                    </div>
                    <div class="utf-no-border">
                        <input type="text" name="name" id="name" placeholder="Full Name" class="form-control" required="">
                    </div>
                    <div class="utf-no-border">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="">
                    </div>
                    <div class="utf-no-border">
                        <input type="password" name="password" id="passwordr" class="form-control" placeholder="Password" required="">
                    </div>

                    <div class="utf-no-border">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Repeat Password" required="">
                    </div>
                    <div class="utf-no-border" id="company_name_div">
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company name" required="">
                    </div>
                    <div class="utf-no-border">
                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone number" required="">
                    </div>
                    <div class="checkbox margin-top-0">
{{--                        <input type="checkbox" id="terms" name="terms">--}}
                        <label for="two-step0"> Registering You Confirm That You Accept <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a>
                        </label>
                    </div>
                    <button class="margin-top-10 button full-width utf-button-sliding-icon ripple-effect" type="submit" >Register <i class="icon-feather-chevrons-right"></i>
                    </button>
                </form>

{{--                <div class="utf-social-login-separator-item"><span>or</span>--}}
{{--                </div>--}}
{{--                <div class="utf-social-login-buttons-block">--}}
{{--                    <button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i> Facebook</button>--}}
{{--                    <button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i> Google+</button>--}}
{{--                    <button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- Sign In Popup / End -->

<!-- Scripts -->
<script src="{{asset('customerfile/scripts/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/chosen.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/magnific-popup.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/owl.carousel.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/rangeSlider.js')}}"></script>
<script src="{{asset('customerfile/scripts/sticky-kit.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/slick.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/mmenu.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/tooltips.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/masonry.min.js')}}"></script>
<script src="{{asset('customerfile/scripts/custom_jquery.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('customerfile/scripts/bootstrap-input-spinner.js')}}"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>
<script type="text/javascript">
    $('input[name="selectdates"]').daterangepicker();
</script>
<script src="{{asset('customerfile/js/jquery-validation/jquery.validate.js')}}"></script>
<script src="{{asset('customerfile/js/jquery-validation/additional-methods.js')}}"></script>
<script src="{{asset('customerfile/js/myscripts.js')}}"></script>
</body>
<div id="tiptip_holder">
    <div id="tiptip_arrow">
        <div id="tiptip_arrow_inner"></div>
    </div>
    <div id="tiptip_content"></div>
</div>

</html>
