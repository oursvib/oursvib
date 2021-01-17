 <!--Loader-->
    <div class="vfx-loader">
        <div class="loader-wrapper">
            <div class="loader-content">
                <div class="loader-dot dot-1"></div>
                <div class="loader-dot dot-2"></div>
                <div class="loader-dot dot-3"></div>
                <div class="loader-dot dot-4"></div>
                <div class="loader-dot dot-5"></div>
                <div class="loader-dot dot-6"></div>
                <div class="loader-dot dot-7"></div>
                <div class="loader-dot dot-8"></div>
                <div class="loader-dot dot-center"></div>
            </div>
        </div>
    </div>
    <!-- Loader end -->

<!-- Header Container -->
        <header id="header-container">
            <!-- Header -->
            <div id="header" class="">
                <div class="container">
				<div class="row">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <div id="logo">
                            <a href="{{URL::to('/')}}">
                                <img src="{{asset('customerfile/images/logo.png')}}" alt="">
                            </a>
                        </div>
                     
                         @include('customer/includes/menu')
                </div>
                </div>
            </div>
            <!-- Header / End -->
        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->

