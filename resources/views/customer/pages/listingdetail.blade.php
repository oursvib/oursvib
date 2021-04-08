@extends('customer.layouts.default')
@section('content')
<!-- Wrapper -->

<div id="wrapper">
    <!-- Titlebar -->


    <!-- Content -->
    <div class="detailpageproperty-slider fullwidth-property-slider margin-bottom-65" style="height: 450px;">
        @foreach($listingdetails->listingimages as $listingimages)
        <a href="https://oursvib.s3.amazonaws.com/large_image/large_{{$listingimages->listing_images}}" class="item mfp-gallery slick-slide"  data-slick-index="0" aria-hidden="false" tabindex="0"><img src="https://oursvib.s3.amazonaws.com/large_image/large_{{$listingimages->listing_images}}"></a>
        @endforeach

    </div>

    <div class="container">
        <div class="row">

            <!-- Property Description -->
            <div class="col-lg-12 col-md-12">
                <!-- Titlebar -->
                <div id="titlebar-dtl-item" class="property-titlebar margin-bottom-0">
                    <div class="property-title">
{{--                        <div class="property-pricing">$22,000/mo</div>--}}
                        <h2>{{$listingdetails->title}} </h2>
                        <span class="utf-listing-address"><i class="icon-material-outline-location-on"></i> {{$listingdetails->address}}, {{ucfirst($listingdetails->listingcity->name)}}, {{ucfirst($listingdetails->listingstate->name)}}, {{ucfirst($listingdetails->listingcountry->name)}}</span>
                        <div>&nbsp;</div>
                        @if($listingdetails->capacity_by==1)
                        <h4>Total Square feet: {{$listingdetails->listingcapacity->area_by}}</h4>
                        @endif
                        @if($listingdetails->capacity_by==2)
                           <h4> Floor signage dimesnion: {{$listingdetails->listingcapacity->floor_signage_dimension}} Sq.ft</h4>
                        @endif
                        @if($listingdetails->capacity_by==1)
                        <ul class="property-main-features">
                            <li>Seated<span>{{$listingdetails->listingcapacity->seating_pax}}</span></li>
                            <li>Standings<span>{{$listingdetails->listingcapacity->standing_pax}}</span></li>
                            <li>Conference<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>
                            <li>Cooktail<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>
                            <li>Classroom<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>
                            <li>Theatre<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>
                            <li>Banquet<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>
                            <li>U shape<span>{{$listingdetails->listingcapacity->conference_pax}}</span></li>

                        </ul>
                        @endif
                        @if($listingdetails->capacity_by==2)
                        <ul class="property-main-features">
                            <li>Height<span>{{$listingdetails->listingcapacity->height}} Sq.ft</span></li>
                            <li>Length<span>{{$listingdetails->listingcapacity->length}} Sq.ft</span></li>
                            <li>Width<span>{{$listingdetails->listingcapacity->width}} Sq.ft</span></li>
                            <li>Screen size<span>{{$listingdetails->listingcapacity->screen_size}} Sq.ft</span></li>
                            <li>Panel size<span>{{$listingdetails->listingcapacity->panel_size}} Sq.ft</span></li>
                            <li>Floor signage dimesnion<span>{{$listingdetails->listingcapacity->floor_signage_dimension}} Sq.ft</span></li>
                        </ul>
                        @endif
                    </div>
                </div>
                @if($listingdetails->dvrlink)
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>3D VR video </h3>
                    </div>
                    <div >
                        <iframe width="100%" height="450" src="{{$listingdetails->dvrlink}}" allowfullscreen=""></iframe>
                    </div>
                @endif
                @if($listingdetails->video)
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Video</h3>
                    </div>
                    <div class="">
                        <iframe width="100%" height="450" src="{{$listingdetails->video}}" allowfullscreen=""></iframe>
                    </div>
                @endif
                <div class="utf-desc-headline-item margin-bottom-0">
                    <h3>Check Availability</h3>
                </div>
                <form name="checkavailabilityform" id="checkavailabilityform">
                <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                    <div class="row">
                    <div class="col-md-3">
                        <input type="hidden" name="listing" id="listing" value="{{$listingdetails->id}}">
                            <input type="text" name="bookingfrom" id="bookingfrom" class="form-control"  placeholder="From" value="" readonly/>

                    </div>
                     <div class="col-md-3">
                            <input type="text" name="bookingto" id="bookingto" class="form-control" placeholder="To"  value="" readonly/>
                     </div>
                     <div class="col-md-3">
                            <input type="button" id="checkavailability" class="form-control"  value="Check availabilty"/>
                     </div>
                     <div class="col-md-3">
                            <input type="button" id="proceedbooking" class="form-control"  value="Proceed with booking" style="display: none;"/>
                     </div>
                    </div>
                    <br>
                    <div class="row">
                        <div id="messagecenter" class="col-md-12" >

                        </div>
                    </div>
                </div>
                    @csrf
                </form>
                <div class="utf-desc-headline-item margin-bottom-0">
                    <h3>Pricing</h3>
                </div>
                <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="pricing-list-container" howu-index="416">

                                <ul class="" howu-index="414">
                                @foreach($listingdetails->listingprice->sortBy('billing_type') as $pricing)
                                    <li howu-index="413">
                                        <h5 howu-index="412">
                                            @if($pricing->billing_type==1) Hourly @elseif($pricing->billing_type=='2') 12 Hours @else 24 Hours @endif</h5>
{{--                                        <p howu-index="411">8 Hours ---}}
{{--                                            Additional Hour RM100 ---}}
{{--                                            Exclude basin ---}}
{{--                                            Per Hour RM 200--}}
{{--                                        </p>--}}
                                        <span howu-index="410">RM {{$pricing->normal_price}} </span>
                                    </li>
                                @endforeach
                                </ul>

                                <!-- Food List -->

                            </div>

                        </div>

                    </div>
                </div>


                @if($listingdetails->supporting_document)
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Broucher</h3>
                    </div>
                    <div class="">
                        <iframe width="100%" height="450" src="https://oursvib.s3.amazonaws.com/supporting_documents/{{$listingdetails->supporting_document}}" allowfullscreen=""></iframe>
                    </div>
                @endif

                <div class="property-description">
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Description</h3>
                    </div>
                    <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                        <div class="row">
                            <div class="col-md-12"><div class="show-more" id="show-more">
                                    {!! $listingdetails->description !!}
                                    <a href="#" class="show-more-button" id="show-more-button">Show More <i class="sl sl-icon-plus"></i></a>
                                </div></div>

                        </div>
                    </div>
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>About</h3>
                    </div>
                    <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                        <div class="row">
                            <div class="col-md-12"><div class="show-more" id="show-more-about">
                                    {!! $listingdetails->about !!}
                                    <a href="#" class="show-more-button" id="show-more-button-about">Show More <i class="sl sl-icon-plus"></i></a>
                                </div></div>

                        </div>
                    </div>
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Team</h3>
                    </div>
                    <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                        <div class="row">
                            <div class="col-md-12"><div class="show-more" id="show-more-team">
                                    {!! $listingdetails->team !!}
                                    <a href="#" class="show-more-button" id="show-more-button-team">Show More <i class="sl sl-icon-plus"></i></a>
                                </div></div>

                        </div>
                    </div>
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Amenities</h3>
                    </div>
                    <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                        <div class="row" id="titlebar-dtl-item">
                            <div class="col-md-12">
                                <ul class="property-main-features">
                                @foreach($amenity as $amenites)
                                 <li>{{ $amenites->name }}</li>
                                @endforeach
                                </ul>
                            </div>


                        </div>
                    </div>
                    <div class="utf-desc-headline-item margin-bottom-0">
                        <h3>Activities you can host</h3>
                    </div>
                    <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                        <div class="row" id="titlebar-dtl-item">
                            <div class="col-md-12">
                                <ul class="property-main-features">
                                @foreach($activity as $actic)
                                 <li>{{ $actic->name }}</li>
                                @endforeach
                                </ul>
                            </div>


                        </div>
                    </div>
                    <!-- Description -->




                    <!-- Video -->


                    <!-- Location -->
{{--                    <div class="utf-desc-headline-item margin-bottom-0">--}}
{{--                        <h3>Location</h3>--}}
{{--                    </div>--}}
{{--                    <div id="propertyMap-container">--}}
{{--                        <iframe--}}
{{--                            width="100%"--}}
{{--                            height="450"--}}
{{--                            style="border:0"--}}
{{--                            loading="lazy"--}}
{{--                            allowfullscreen--}}
{{--                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyApX7NNTjroBdCrVTT6VOH-XzfLz0ccpwk&q= {{$listingdetails->address}}, {{ucfirst($listingdetails->listingcity->name)}}, {{ucfirst($listingdetails->listingstate->name)}}, {{ucfirst($listingdetails->listingcountry->name)}}">--}}
{{--                        </iframe>--}}
{{--                    </div>--}}




                    <!-- Video -->
                    <div class="margin-bottom-0">
                      &nbsp;
                    </div>

                </div>

                <!-- Add Comment -->


            </div>
        </div>
        <!-- Property Description / End -->


    </div>
</div>
@stop
