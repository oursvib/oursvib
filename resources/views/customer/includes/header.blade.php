<!-- Header Container -->
<header id="header-container">
    <!-- Header -->
    <div id="header" class="">
        <div class="container">
            <div class="row">
                <!-- Left Side Content -->
                <div class="left-side">
                    <div id="logo">
                        <a href="index.php">
                            <img src="{{asset('customerfile/images/logo.png')}}" alt="">
                        </a>
                    </div>
                    <div class="mmenu-trigger">
                        <button class="hamburger hamburger--collapse" type="button"> <span class="hamburger-box"> <span class="hamburger-inner"></span> </span>
                        </button>
                    </div>
                    <!-- Main Navigation -->
                    @include('customer/includes/menu')
                    <div class="clearfix"></div>
                </div>
                <!-- Left Side Content / End -->

                <!-- Right Side Content / End -->
                <div class="right-side">
                    <div class="header-widget">
                        <a href="#utf-signin-dialog-block" class="popup-with-zoom-anim log-in-button sign-in"><i class="icon-line-awesome-user"></i> <span>Signin / Signup</span></a>
                    </div>
                </div>
                <!-- Right Side Content / End -->
            </div>
        </div>
    </div>
    <!-- Header / End -->
</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
