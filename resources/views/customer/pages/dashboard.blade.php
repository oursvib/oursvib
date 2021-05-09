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
                            <h2>My Dashboard</h2>
                            <!-- Breadcrumbs -->
                            <nav id="breadcrumbs">
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li>Dashboard</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  padding-top-50 padding-bottom-50">
            <div class="row">
                <!-- Sidebar -->
            @include('customer.includes.usersidebar')
            <!-- Sidebar / End -->
                <!-- Property Description -->
                <div class="col-lg-9 col-md-9">
                    <!-- Titlebar -->


                    <div class="property-description">
                        <!-- Description -->
                        <div class="utf-desc-headline-item margin-bottom-0 margin-top-0">
                            <h3>My Bookings</h3>
                        </div>
                        <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                            <div class="col-md-12">
                                <table class="table table-striped table-bordered" width="98%" align="center">
                                    <thead>
                                    <td>#</td>
                                    <td>Listing</td>
                                    <td>Start date</td>
                                    <td>End date</td>
                                    <td>Amount</td>
                                    </thead>
                                    @foreach($bookingdetails as $i=>$booking)
                                        <tr>
                                            <td>{{$i+1}}</td>
                                            <td><a href="viewlisting/{{$booking->listing->id}}">{{$booking->listing->title}}</a></td>
                                            <td>{{$booking->start_date}}</td>
                                            <td>{{$booking->end_date}}</td>
                                            <td>RM {{$booking->amountpaid/100}}</td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Property Description / End -->


        </div>
    </div>
    </div>
    <script>

    </script>
@stop

