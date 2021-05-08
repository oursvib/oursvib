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
                            <h2>Preview booking</h2>
                            <!-- Breadcrumbs -->
                            <nav id="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Preview booking</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ">
            <div class="row padding-top-50 padding-bottom-20">
                <div class="col-md-12">
                    <h3>Order Summary</h3>
                </div>
            </div>
            <div class="row padding-bottom-50">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="cart-table cart-table--sm pt-3 pt-md-0">
                                <div class="cart-table-prd cart-table-prd--head py-1 d-none d-md-flex">
                                    <div class="cart-table-prd-image text-center">
                                        Image
                                    </div>
                                    <div class="cart-table-prd-content-wrap">
                                        <div class="cart-table-prd-info">Name</div>
                                        <div class="cart-table-prd-price">Price</div>
                                    </div>
                                </div>

                                <div class="cart-table-prd">
                                    <div class="cart-table-prd-image">
                                        <a href="/viewlisting/{{$listings->id}}" class="prd-img"><img
                                                class="fade-up ls-is-cached lazyloaded"
                                                src="{{URL::asset('storage/listing_images/thumbnail/thumbnail_'.$listings->listingimages->where('listing_id',$listings->id)->pluck('listing_images')->first())}}"
                                                alt=""></a>
                                    </div>
                                    <div class="cart-table-prd-content-wrap">
                                        <div class="cart-table-prd-info">
                                            <h2 class="cart-table-prd-name"><a
                                                    href="/viewlisting/{{$listings->id}}">{{$listings->title}}</a></h2>
                                            <p>From: {{$bookinginformation['startingtime']}} -
                                                To: {{$bookinginformation['endtime']}} <a
                                                    href="/modifybooking/{{$listings->id}}"><i
                                                        class="fa fa-pencil"></i></a></p>
                                        </div>
                                        <div class="cart-table-prd-price-total">
                                            RM {{number_format($pricetotal,2)}}
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-table-prd cart-table-prd--head py-1 d-none d-md-flex">
                                    <div class="cart-table-prd-image text-center">
                                        Addon
                                    </div>
                                    <div class="cart-table-prd-content-wrap">
                                        <div class="cart-table-prd-info">&nbsp;</div>
                                        <div class="cart-table-prd-price">&nbsp;</div>
                                    </div>
                                </div>
                                @foreach($additinaladdon as $addon)
                                    <div class="cart-table-prd">
                                        <div class="cart-table-prd-image">
                                            <p>{{$addon->name}}</p>
                                        </div>
                                        <div class="cart-table-prd-content-wrap">
                                            <div class="cart-table-prd-info">
                                                <h2 class="cart-table-prd-name">&nbsp;</h2>
                                            </div>
                                            <div class="cart-table-prd-price-total">
                                                @if($addon->type==1)
                                                    RM 0
                                                @else
                                                    RM {{$addon->amount}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row padding-bottom-50">
                <div class="col-md-8">&nbsp;</div>
                <div class="col-md-3 text-center">

                    <div class="mt-2"></div>
                    <div class="cart-total-sm padding-top-10 padding-bottom-10">
                        <span class="card-total-price">Total </span>
                        <span class="card-total-price">RM {{$pricetotal+$additinaladdonsum}}</span>
                    </div>
                    @if(Auth::check())
                        <div class="clearfix mt-2">
                            <a href="/customer/paymentprocess"
                               class="btn btn--lg w-100 button">Proceed with payment</a>
                        </div>
                    @else
                        <div class="clearfix mt-2">
                            <a href="#utf-signin-dialog-block" type="button" id="placeorder"
                               class="popup-with-zoom-anim btn btn--lg w-100 button sing-in">Place Order</a>
                        </div>
                    @endif
                </div>
                <div class="col-md-1">&nbsp;</div>
            </div>

            <!--Order Summary-->

        </div>
    </div>

@stop
