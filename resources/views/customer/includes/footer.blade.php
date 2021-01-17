
 <!-- Footer -->
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <a href="index.html">
                            <img class="footer-logo" src="{{asset('customerfile/images/footer_logo.png')}}" alt="">
                        </a>
                        <p>Oursvib is a hybrid multi booking marketplace for Venue, Space, Happenings and Services – we connect business and customers and business to business. Oursvib helps users to easily Plan Events, Book Venues and Host Parties all at your fingertips! Business’s get to enjoy brand exposure through our “Free Listing”, “3D VR” and “Digital Marketing” solutions.</p>
                    </div>
                    <div class="col-md-4 col-sm-3 col-xs-6">
                        <h4>Useful Links</h4>
                        <ul class="utf-footer-links-item">
                             <li><a class="current" href="#">Home</a></li>
								<li><a class="active" href="">Venue</a></li>
								<li><a class="" href="#">Space</a></li>
								<li><a class="" href="#">Services</a></li>
								<li><a class="" href="#">Happenings</a>
									<ul class="sub-drop-main">
										<li><a href="#">Events Ticket</a></li>
										<li><a href="#">Activity Ticket</a></li>
									</ul>
								</li>
								<li><a class="" href="#">Digital</a>
									<ul class="sub-drop-main">
										<li class="menu-item-has-children"><a href="#">Interactive Content</a> 
											<ul class="sub-drop-sub">
												<li><a href="#">3D VR Walkthrough Gallery</a></li>
												<li><a href="#">Get 3D VR Pricing &amp; Plan</a></li>
												<li><a href="#">360 Aerial Panoramic Gallery</a></li>
												<li><a href="#">Get 360 Aerial Pricing &amp; Plan</a></li>
											</ul>
										</li>
										<li><a href="#">Digital Marketing</a></li>
									</ul>
								</li> 
                        </ul>
                    </div>
                    
                    <div class="col-md-4 col-sm-3 col-xs-6 contactinfosec">
                       <h4>Get in Touch</h4>
							<div class="partners">
								<p class="part-icon"><i class="fa fa-map-marker"></i> <span>G-2-3, Boulevard Business Park, off Jalan Kuching, 51200, Kuala Lumpur</span></p>
								<p class="part-icon"><i class="fa fa-envelope"></i> <span><a href="mailto: sales@oursvib.com">sales@oursvib.com</a> | 
									<a href="mailto: support@oursvib.com">support@oursvib.com</a></span></p>
								 <p class="part-icon"><i class="fa fa-handshake-o"></i> <span><a href="">Be our CSR partner</a></span></p>
								 <p class="part-icon"><i class="fa fa-cutlery"></i> <span><a href="">Be our Food Bank partner</a></span></p>
								 <p class="part-icon"><i class="fa fa-users"></i> <span><a href="https://www.oursv#">Join as our Affiliate program</a></span></p>
							</div>
							<h4 class="widget-title">Follow Us</h4>
						<p>Follow &amp; Subscribe your email to get new business tips.</p>
						 <a href="#"><i class="fa-3x fa fa-facebook-square"></i></a> <a href="#"><i class="fa-3x fa fa-twitter-square"></i></a> <a href="#"><i class="fa-3x fa fa-youtube-square"></i></a> 
					 
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
