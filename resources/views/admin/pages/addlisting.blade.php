@extends('admin.layouts.default')
@section('content')

    <div class="content p-4">
        <h2 class="mb-4">Add listing</h2>

            <div class="alert alert-danger" id="message" style="display:none"></div>

        <div class="card mb-4">

            <div class="card-body">
                <div>
                    <form id="addlistingwizard" action="#" enctype="multipart/form-data">
                        @csrf
                    <h3> General information</h3>
                    <fieldset>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select vendor</label>

                                <select class="form-control select2 required" name="vendor_id" id="vendor_id">
                                    <option value="">select</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->company_name}} - {{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select root category</label>

                                <select class="form-control select2 required" name="root_category" id="root_category">
                                    <option value="">select</option>
                                    @foreach($rootcategory as $root)
                                        <option value="{{$root->id}}"> {{$root->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select parent category</label>

                                <select class="form-control select2 required" name="parent_category" id="parent_category">

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select child category</label>

                                <select class="form-control select2 required" name="child_category" id="child_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select niche category</label>

                                <select class="form-control select2 required" name="niche_category" id="niche_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Listing type</label>

                                <select class="form-control select2 required" name="listing_type" id="listing_type">
                                    <option value="">select</option>
                                    @foreach($listingtype as $ltype)
                                        <option value="{{$ltype->id}}"> {{$ltype->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Title</label>

                                <input type="text" name="title" id="title" class="form-control required">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Description</label>

                                <textarea name="description"  id="description" class="form-control required"></textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>About us</label>

                                <textarea name="aboutus"  id="aboutus" class="form-control required"></textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Team</label>

                                <textarea name="team"  id="team" class="form-control required"></textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Unique Service</label>

                                <input type="text"  name="unique_services"  id="unique_services" class="form-control"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Stragetic Partners</label>

                                <input type="text"  name="stragetic_patner"  id="stragetic_patner" class="form-control"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Guest Experience</label>

                                <input type="text"  name="guest_experience"  id="guest_experience" class="form-control"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>News Hightlights</label>

                                <input type="text" name="news_highlight"  id="guest_experience" class="form-control"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Green Innitiative</label>

                                <input type="text" name="green_innitiative"  id="green_innitiative" class="form-control"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Star Rating</label>

                                <input type="number" name="star_rating"  id="star_rating" class="form-control" min="1" max="5"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Be our CSR Partner</label>
                                <select>
                                    <option>Select</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Be our Food Partner</label>

                                <input type="number" name="star_rating"  id="star_rating" class="form-control" min="1" max="5"></input>
                            </div>

                        </div>
                    </fieldset>
                    <h3> Location & pricing</h3>
                    <fieldset>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Address</label>

                                <input type="text" name="address"  id="address" class="form-control required">
                            </div>

                        </div>
                        <div style="clear: both">&nbsp;</div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Country</label>

                                <select class="form-control select2 required" name="country" id="country">
                                    <option value="">select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->countryId}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>State</label>

                                <select class="form-control select2 required" name="state" id="state">

                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>City</label>

                                <select class="form-control select2 required" name="city" id="city">

                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Zipcode</label>

                                <input type="text" name="zipcode" id="zipcode" class="form-control required">

                                </input>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-12 nearbyattraction">
<br>
                                <label>Strategic location and nearby </label><input type="button" value="Add item" class="btn btn-primary additembutton addnearby" />
                                <input type="hidden" name="itemcountnew" id="itemcountnew" value="0">
                                <div class="col-md-12" class="mainitem">

                                    <div class="col-md-5 nearby">
                                    <input type="text" name="nearby[0][location]"  class="form-control" placeholder="location">
                                    </div>
                                    <div class="col-md-5 nearby">
                                        <input type="text"  name="nearby[0][distance]"  class="form-control" placeholder="distance in KM"></div>

                                    <br><br>
                                </div>

                            </div>


                        </div>
                        <div class="form-row">&nbsp;</div>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Billing type</label>

                                <select class="form-control select2 required" name="billing_type" id="billing_type">
                                    <option value="">select</option>
                                    @foreach($billingtype as $billing)
                                        <option value="{{$billing->id}}">{{$billing->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Peak season start</label>

                                <div class="col-xs-1">
                                    <select class="form-control required" name="peakstart" id="peakstart">
                                        <option value="">From</option>
                                        @foreach($months as $key=>$month)
                                            <option value="{{$key}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Peak season end</label>


                                <div class="col-xs-1">
                                    <select class="form-control required" name="peakend" id="peakend">
                                        <option value="">To</option>
                                        @foreach($months as $key=>$month)
                                            <option value="{{$key}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Normal price</label>
                                <div class="input-group col-xs-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" class="form-control required" name="normalprice" id="normalprice">
                                </div>

                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Peak season price</label>
                                <div class="input-group col-xs-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" class="form-control required" name="peakprice" id="peakprice">
                                </div>

                            </div>
                        </div>

                    </fieldset>
                        <h3>Capacity & amenities</h3>
                        <fieldset>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label>
                                        Area by
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="area_by" id="area_by">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">Sq.ft</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                       No of min pax
                                    </label>
                                    <div class="input-group col-xs-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Min</span>
                                        </div>
                                        <input type="text" class="form-control required" name="min_pax" id="min_pax">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        No of max pax
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Max</span>
                                        </div>
                                        <input type="text" class="form-control required" name="max_pax" id="max_pax">

                                    </div>
                                </div>

                            </div>
                            <div class="form-row">&nbsp;</div>
                            <h4>No of pax by different arrangements:</h4>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>
                                        Seating
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="seating_pax" id="seating_pax">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                       Standing
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="standing_pax" id="standing_pax">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>
                                        Cooktail
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="cooktail_pax" id="cooktail_pax">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        Classroom
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="classroom_pax" id="classroom_pax">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>
                                        Theatre
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="theatre_pax" id="theatre_pax">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        Banquet
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="banquet_pax" id="banquet_pax">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label>
                                        Conference
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="conference_pax" id="conference_pax">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        U-shape
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="ushape_pax" id="ushape_pax">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row">&nbsp;</div>
                            <h4>Amenities:</h4>
                            <div class="form-row">
                                @foreach($amenities as $amenity)
                                    <div class="col-md-6">
                                    <h5>{{$amenity->name}}</h5>
                                    @if($amenity->subamenity)
                                        @include('admin.pages.subamenity',['subamenity' => $amenity->subamenity])
                                    @endif
                                    </div>
                                @endforeach

                            </div>

                        </fieldset>
                        <h3>Images & media</h3>
                        <fieldset>
                            <div class="form-row">
                                <label>
                                    Listing images
                                </label>
                                <input type="file" name="images[]" id="uploadFile" class="form-control required" multiple>
                            </div>
                            <div class="form-row">
                                <div id="image_preview"></div>
                            </div>
                            <div class="form-row">
                                <label>
                                    Video link
                                </label>
                                <input type="text" name="videolink" id="videolink"  class="form-control required">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>

@stop



