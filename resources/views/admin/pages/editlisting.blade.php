@extends('admin.layouts.default')
@section('content')

    <div class="content p-4">
        <h2 class="mb-4">Edit listing</h2>

            <div class="alert alert-danger" id="message" style="display:none"></div>

        <div class="card mb-4">

            <div class="card-body">
                <div>
                    <form id="editlistingwizard" action="#" enctype="multipart/form-data">
                        @csrf

                    <h3> General information</h3>
                    <fieldset>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select vendor</label>

                                <select class="form-control select2 required" name="vendor_id" id="vendor_id">
                                    <option value="">select</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}" @if($vendor->id==$listinginfo->vendor_id)selected="selected" @endif>{{$vendor->company_name}} - {{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select root category</label>

                                <select class="form-control select2 required" name="root_category" id="root_category">
                                    <option value="">select</option>
                                    @foreach($rootcategory as $root)
                                        <option value="{{$root->id}}" @if($root->id==$listinginfo->root_category)selected="selected" @endif> {{$root->name}}</option>
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
                                        <option value="{{$ltype->id}}" @if($ltype->id==$listinginfo->listing_type)selected="selected" @endif> {{$ltype->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Title</label>

                                <input type="text" name="title" id="title" class="form-control required" value="{{$listinginfo->title}}">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Description</label>

                                <textarea name="description"  id="description" class="form-control required">{{$listinginfo->description}}</textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>About us</label>

                                <textarea name="aboutus"  id="aboutus" class="form-control required">{{$listinginfo->about}}</textarea>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Team</label>

                                <textarea name="team"  id="team" class="form-control required">{{$listinginfo->team}}</textarea>
                            </div>

                        </div>

                    </fieldset>
                    <h3> Location & pricing</h3>

                    <fieldset>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Unique Service</label>

                                <input type="text"  name="unique_services"  id="unique_services" class="form-control required" value="{{$listinginfo->unique_services}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Stragetic Partners</label>

                                <input type="text"  name="stragetic_patner"  id="stragetic_patner" class="form-control required" value="{{$listinginfo->stragetic_partner}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Guest Experience</label>

                                <input type="text"  name="guest_experience"  id="guest_experience" class="form-control required" value="{{$listinginfo->guest_experience}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>News Hightlights</label>

                                <input type="text" name="news_highlight"  id="news_highlight" class="form-control required" value="{{$listinginfo->news_highlight}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Green Innitiative</label>

                                <input type="text" name="green_innitiative"  id="green_innitiative" class="form-control required" value="{{$listinginfo->green_innitiative}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Star Rating</label>

                                <input type="number" name="star_rating"  id="star_rating" class="form-control" required min="1" max="5" value="{{$listinginfo->star_rating}}"></input>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label>Be our CSR Partner</label>
                                <select class="select2 required" name="csr_partner" id="csr_partner">
                                    <option>Select</option>
                                    <option value="1" @if($listinginfo->csr_partner==1) selected="selected" @endif> Yes</option>
                                    <option value="0" @if($listinginfo->csr_partner==0) selected="selected" @endif>No</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Be our Food Partner</label>

                                <select class="select2 required" name="food_partner" id="food_partner">
                                    <option>Select</option>
                                    <option value="1" @if($listinginfo->food_partner==1) selected="selected" @endif> Yes</option>
                                    <option value="0" @if($listinginfo->food_partner==0) selected="selected" @endif>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Address</label>

                                <input type="text" name="address"  id="address" class="form-control required" value="{{$listinginfo->address}}">
                            </div>

                        </div>
                        <div style="clear: both">&nbsp;</div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label>Country</label>

                                <select class="form-control select2 required" name="country" id="country">
                                    <option value="">select</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->countryId}}" @if($country->countryId==$listinginfo->country) selected="selected" @endif>{{$country->name}}</option>
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

                                <input type="text" name="zipcode" id="zipcode" class="form-control required" value="{{$listinginfo->zipcode}}">

                                </input>
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="col-md-12 nearbyattraction">
<br>
                                <label>Strategic location and nearby </label><input type="button" value="Add item" class="btn btn-primary additembutton addnearby" />
                                <input type="hidden" name="itemcountnew" id="itemcountnew" value="<?php echo count($listinginfo->listingnearby) - 1?>">
                                @foreach($listinginfo->listingnearby as $key=>$nearby)
                                    <div class="col-md-12" class="mainitem">

                                    <div class="col-md-5 nearby">
                                    <input type="text" name="nearby[{{$key}}][location]"  class="form-control" placeholder="location" value="{{$nearby->nearby}}">
                                    <input type="hidden" name="nearby[{{$key}}][nearbyid]"  class="form-control" value="{{$nearby->id}}">
                                    </div>
                                    <div class="col-md-5 nearby">
                                        <input type="text"  name="nearby[{{$key}}][distance]"  class="form-control" placeholder="distance in KM" value="{{$nearby->distance}}"></div>
                                        <div class="col-md-1 nearby"><input type="button" value="X" class="btn btn-danger removenearby"></div>
                                    <br><br>
                                    </div>
                                @endforeach
                            </div>


                        </div>
                        <div class="form-row">&nbsp;</div>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Billing type</label>

                                <select class="form-control select2 required" name="billing_type" id="billing_type">
                                    <option value="">select</option>
                                    @foreach($billingtype as $billing)
                                        <option value="{{$billing->id}}"  @if($billing->id==$listinginfo->listingprice->billing_type) selected="selected" @endif>{{$billing->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Peak season start</label>

                                <div class="col-xs-1">
                                    <select class="form-control required" name="peakstart" id="peakstart">
                                        <option value="">From</option>
                                        @foreach($months as $key=>$month)
                                            <option value="{{$key}}"   @if($key==$listinginfo->listingprice->peak_start) selected="selected" @endif>{{$month}}</option>
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
                                            <option value="{{$key}}" @if($key==$listinginfo->listingprice->peak_end) selected="selected" @endif>{{$month}}</option>
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
                                    <input type="text" class="form-control required" name="normalprice" id="normalprice" value="{{$listinginfo->listingprice->normal_price}}">
                                </div>

                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Peak season price</label>
                                <div class="input-group col-xs-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                    </div>
                                    <input type="text" class="form-control required" name="peakprice" id="peakprice" value="{{$listinginfo->listingprice->peak_price}}">
                                </div>

                            </div>
                        </div>
                    </fieldset>
                        <h3>Additional fee</h3>
                        <fieldset>
                            <div class="form-row">
                                @foreach($additionalfees as $addfee)
                                    <div class="col-md-4" style="border: 1px dashed #000;border-radius: 5px;padding:2px;margin: 6px;max-width:32%;">
                                        <div class="col-md-12">
                                            <label>{{$addfee->name}}</label>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="col-md-6" style="float: left">
                                                <input type="hidden" name="additional_fee[{{$addfee->id}}][additional_id]" value="{{$addfee->id}}">
                                                <select class="select2" name="additional_fee[{{$addfee->id}}][type]" id="{{$addfee->id}}" onchange="showAdditionalAmount(this)" >
                                                    <option value="0" @if($listinginfo->listingadditional->where('additional_id',$addfee->id)->pluck("type")->first()=='0') selected="selected" @endif >No</option>
                                                    <option value="1"  @if($listinginfo->listingadditional->where('additional_id',$addfee->id)->pluck("type")->first()=='1') selected="selected" @endif  >Yes,free</option>
                                                    <option value="2"  @if($listinginfo->listingadditional->where('additional_id',$addfee->id)->pluck("type")->first()=='2') selected="selected" @endif >Yes,paid</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 amount_{{$addfee->id}}" @if($listinginfo->listingadditional->where('additional_id',$addfee->id)->pluck("type")->first()!='2')  style="float: left;display:none;" @endif style="float: left;">
                                                <div class="input-group">

                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">RM</span>
                                                    </div>
                                                    <input type="text" class="form-control required"  name="additional_fee[{{$addfee->id}}][amount]" id="amount_{{$addfee->id}}" value="{{$listinginfo->listingadditional->where('additional_id',$addfee->id)->pluck("amount")->first()}}">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endforeach

                        </fieldset>
                        <h3>Capacity & amenities</h3>
                        <fieldset>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label></label>
                                    <div class="col-md-6">
                                        <input type="radio" id="capacity_by" name="capacity_by" value="1" style="display: inline-block" checked="checked" @if($listinginfo->capacity_by==1) checked="checked" @endif> By Area
                                        <input type="radio" id="capacity_by" name="capacity_by" value="2" style="display: inline-block" @if($listinginfo->capacity_by==2) checked="checked" @endif> By Dimension
                                    </div>
                                </div>
                            </div>
                            <div class="form-row byarea">
                                <div class="col-md-4">
                                    <label>Area by</label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="area_by" id="area_by" value="{{$listinginfo->listingcapacity->area_by}}">
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
                                        <input type="text" class="form-control required" name="min_pax" id="min_pax" value="{{$listinginfo->listingcapacity->min_pax}}">

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
                                        <input type="text" class="form-control required" name="max_pax" id="max_pax" value="{{$listinginfo->listingcapacity->max_pax}}">

                                    </div>
                                </div>
                            </div>

                            <h4 class="byarea">No of pax by different arrangements:</h4>
                            <div class="form-row byarea">
                                <div class="col-md-6">
                                    <label>
                                        Seating
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="seating_pax" id="seating_pax" value="{{$listinginfo->listingcapacity->seating_pax}}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                       Standing
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="standing_pax" id="standing_pax" value="{{$listinginfo->listingcapacity->standing_pax}}">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row byarea">
                                <div class="col-md-6">
                                    <label>
                                        Cooktail
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="cooktail_pax" id="cooktail_pax" value="{{$listinginfo->listingcapacity->cooktail_pax}}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        Classroom
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="classroom_pax" id="classroom_pax" value="{{$listinginfo->listingcapacity->classroom_pax}}">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row byarea">
                                <div class="col-md-6">
                                    <label>
                                        Theatre
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="theatre_pax" id="theatre_pax" value="{{$listinginfo->listingcapacity->theatre_pax}}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        Banquet
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="banquet_pax" id="banquet_pax" value="{{$listinginfo->listingcapacity->banquet_pax}}">

                                    </div>
                                </div>


                            </div>
                            <div class="form-row byarea">
                                <div class="col-md-6">
                                    <label>
                                        Conference
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="conference_pax" id="conference_pax" value="{{$listinginfo->listingcapacity->conference_pax}}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        U-shape
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="ushape_pax" id="ushape_pax" value="{{$listinginfo->listingcapacity->ushape_pax}}">

                                    </div>
                                </div>


                            </div>
                            <h4 class="bydimension">Active Display area:</h4>
                            <div class="form-row bydimension">
                                <div class="col-md-4">
                                    <label>
                                       Height
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="height" id="height" value="{{$listinginfo->listingcapacity->height}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">Sq.ft</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Length
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="length" id="length" value="{{$listinginfo->listingcapacity->length}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">Sq.ft</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Width
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="width" id="width" value="{{$listinginfo->listingcapacity->width}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">Sq.ft</span>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="form-row bydimension">&nbsp;</div>
                            <h4 class="bydimension">Display Distance & visibility :</h4>
                            <div class="form-row bydimension">
                                <div class="col-md-4">
                                    <label>
                                      Letter height
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="letter_height" id="letter_height" value="{{$listinginfo->listingcapacity->letter_height}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Best impact
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="best_impact" id="best_impact" value="{{$listinginfo->listingcapacity->best_impact}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>
                                        Width
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="max_readable_distance" id="max_readable_distance" value="{{$listinginfo->listingcapacity->max_readable_distance}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="form-row bydimension">&nbsp;</div>
                            <h4 class="bydimension">Floor Signage Dimension</h4>

                            <div class="form-row bydimension">

                                <div class="col-md-6">
                                    <label>
                                        By Square Feet
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="floor_signage_dimension" id="floor_signage_dimension" value="{{$listinginfo->listingcapacity->floor_signage_dimension}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">Sq.ft</span>
                                        </div>
                                    </div>
                                </div>




                            </div>
                            <h4 class="bydimension">LED/LCD display</h4>

                            <div class="form-row bydimension">

                                <div class="col-md-6">
                                    <label>
                                        Screen size
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="screen_size" id="screen_size" value="{{$listinginfo->listingcapacity->screen_size}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        Panel size
                                    </label>
                                    <div class="input-group col-xs-1">

                                        <input type="text" class="form-control required" name="panel_size" id="panel_size" value="{{$listinginfo->listingcapacity->panel_size}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon1">px</span>
                                        </div>
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

                        <h3>Activites</h3>
                        <fieldset>
                            <div class="form-row">                            
                                @foreach($activities as $activity)
                                    <div class="col-md-12">
                                        <h5>{{$activity->name}}:</h5>
                                        @if($activity->subactivity)
                                            @include('admin.pages.subactivity',['subactivity' => $activity->subactivity])
                                        @endif
                                    </div>
                                    <div>&nbsp;</div>
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
                                    Listing document
                                </label>
                                <input type="file" name="supporting_document" id="supporting_document" class="form-control" multiple>
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
    <script type="text/javascript">
        showParentCategory({{$listinginfo->root_category}},{{$listinginfo->parent_category}})
        showChildCategory({{$listinginfo->parent_category}},{{$listinginfo->child_category}})
        showNicheCategory({{$listinginfo->child_category}},{{$listinginfo->niche_category}})
        showState({{$listinginfo->country}},{{$listinginfo->state}})
        showCity({{$listinginfo->state}},{{$listinginfo->city}})
        capacityby({{$listinginfo->capacity_by}})
    </script>
@stop



