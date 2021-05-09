@extends('customer.layouts.default')
@section('content')
    <div id="wrapper">
        <!-- Titlebar -->
        <div class="parallax titlebar"
             style="background-image: url({{asset('customerfile/images/listings-parallax.jpg')}}); background-attachment: fixed;">
            <div id="titlebar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Booking Success</h2>
                            <!-- Breadcrumbs -->
                            <nav id="breadcrumbs">
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li>Booking failure</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section class="section-b-space padding-top-50 padding-bottom-50 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="failure-text"><i class="fa fa-times-circle" aria-hidden="true"></i>
                            <h2>Sorry</h2>
                            <p>Payment failure,Booking not confirmed</p>
                            <p>Transaction ID: {{ Session::get('invoiceno') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

    </script>
@stop

