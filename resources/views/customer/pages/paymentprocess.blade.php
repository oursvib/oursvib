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
                            <h2>Checkout</h2>
                            <!-- Breadcrumbs -->
                            <nav id="breadcrumbs">
                                <ul>
                                    <li><a href="index.html">Home</a></li>
                                    <li>Checkout</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="https://ecom.pbebank.com/PGW/Pay/Process" method="post" id="f" name="f">
        <div class="container ">
@csrf
            <div class="row padding-top-50 padding-bottom-30">

                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h2>Payment Methods</h2>
                                {{--                        <div class="clearfix">--}}
                                {{--                            <input id="formcheckoutRadio5" value="" name="radio2" type="radio" class="radio" checked="checked">--}}
                                {{--                            <label for="formcheckoutRadio5">Direct pay</label>--}}
                                {{--                        </div>--}}
                                <div class="clearfix">
                                    <input id="formcheckoutRadio4" value="1" name="radio2" type="radio" class="radio"
                                           checked="checked">
                                    <label for="formcheckoutRadio4">Credit Card</label>
                                    <input id="formcheckoutRadio5" value="2" name="radio2" type="radio" class="radio"
                                           >
                                    <label for="formcheckoutRadio5">Debit Card</label>
                                </div>
                                <input class="form-control" size=50 id="merID" value="" name="merID" type="hidden">
                                <div class="mt-2"></div>
                                <label>Card Type</label>
                                <div class="form-group">
                                    <select class="form-control" name="cardtype" id="cardtype">
                                        <option value="">Select</option>
                                        <option value="1">Master card</option>
                                        <option value="2">Visa card</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                <label>Card Number</label>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control--sm" name="PAN" id="PAN" placeholder="Ex:4211000000000000" maxlength="16"/>
                                </div>
                                </div>
                                <div class="mt-2">
                                <label>Expiry Date</label>
                                <div class="form-group">
                                    <input size="4" type="text" class="form-control form-control--sm" name="expiryDate" maxlength="4"
                                           id="expiryDate" placeholder="MMYY"/>
                                </div>
                                </div>
                                <div class="mt-2">
                                    <label>CVV Code</label>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control--sm" name="CVV2" id="CVV2" maxlength="4"/>
                                    </div>
                                </div>
                                <div style="visibility: hidden">
                                    <input type="hidden" class="form-control" size=50 id="credential" value=Y name= "credential" >
                                    <input type="hidden" class="form-control" size=50 id="invoiceNo" value={{$invoicenumber}} name="invoiceNo">
                                    <input type="hidden" class="form-control" size=50 id="amount" value="{{$grandtotal}}" name="amount">
                                    <input type="hidden" id="securityMethod" name="securityMethod" value="SHA1">
                                    <input size=50 id="sha1" type="radio" value="SHA1" name="method" checked="checked">SHA1<br>
                                    <input type="hidden" size=50 id="postURL"  value="{{route('paymentsresponse')}}" name="postURL">
                                    <input type="hidden" class="form-control" size=50 id="secretCode" value="BCTECHP01" name="secretCode">
                                    <input  type="hidden" class="form-control" size=50 id="secretString" name="secretString">
                                    <input class="form-control" size=50 id="securityKeyReq" name="securityKeyReq">
                                </div>

                            </div>
                        </div>

                        <div class="mt-2"></div>

                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="mt-2"></div>
                                <div class="cart-total-sm padding-top-10 padding-bottom-10">
                                    <span class="card-total-price">Total</span>
                                    <span class="card-total-price">RM {{$pricetotal+$additinaladdonsum}}</span>

                                </div>
                                <div class="clearfix mt-2">
                                    <button type="submit" class="btn btn--lg w-100 button" id="placeorder">Place Order</button>
                                </div>
                                <div class="clearfix mt-2">
                                <div id="messagecenter">

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <input type="hidden" name="listing_id" id="listing_id" value="{{$bookinginformation['listing_id']}}">
            <input type="hidden" name="starttime" id="starttime" value="{{$bookinginformation['startingtime']}}">
            <input type="hidden" name="endtime" id="endtime" value="{{$bookinginformation['endtime']}}">
            <input type="hidden" name="vendorid" id="vendorid" value="{{$listings->vendor_id}}">
            <!--Order Summary-->


        </div>
        </form>
    </div>
    <script>

    </script>
@stop

