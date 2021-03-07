@extends('customer.layouts.default')
@section('content')
    <div id="wrapper">
    <!-- Titlebar -->
    <div class="parallax titlebar" style="background-image: url({{asset('customerfile/images/listings-parallax.jpg')}}); background-attachment: fixed;">
        <div id="titlebar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Listings Page Demo</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Listings Page Demo</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Search Container -->
    <div class="utf-main-search-container-area inner-search-item">
        <div class="container">
            <div class="search-container ">
                <h2>The World of Online Reservation &amp; Booking Marketplace <br></h2>
                <div class="announce">Zero Subscription Fee | Free Listing </div>
                @include('customer.includes.searchinner')
            </div>
        </div>
    </div>
    <!-- Main Search Container / End -->

    <!-- Content -->
    <div class="container padding-bottom-30">
        <div class="row sticky-wrapper">
            <!-- Sidebar -->
            @include('customer.includes.sidebar')
            <!-- Sidebar / End -->
            <div class="col-md-8">
                <!-- Sorting -->
                <div class="utf-sort-box-aera">
                    <div class="sort-by">
                        <label>Sort By:</label>
                        <div class="sort-by-select">
                            <select data-placeholder="Default Properties" class="utf-chosen-select-single-item" style="display: none;">
                                <option>Default Properties</option>
                                <option>Low to High Price</option>
                                <option>High to Low Price</option>
                                <option>Newest Properties</option>
                                <option>Oldest Properties</option>
                            </select>
                        </div>
                    </div>
                    <div class="utf-layout-switcher">
                        <a href="#" class="grid active"><i class="sl sl-icon-grid"></i></a>
                        <a href="#" class="list "><i class="sl sl-icon-list"></i></a>

                    </div>
                </div>

                <!-- Listings -->
                <div class="utf-listings-container-area grid-layout" id="searchresult">

                </div>
                <!-- Listings Container / End -->

                <div class="utf-pagination-container margin-top-20">
                    <nav class="pagination">
                        <ul id="pagelinks">

                        </ul>
                    </nav>
                </div>


            </div>


        </div>
    </div>

    <!-- Footer -->
    <div id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <a href="index.html">
                        <img class="footer-logo" src="images/footer_logo.png" alt="">
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

@stop
