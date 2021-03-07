<div class="col-md-4">
    <div class="sidebar">


        <!-- Widget -->
        <div class="widget utf-sidebar-widget-item">
            <div class="utf-boxed-list-headline-item">
                <h3>Narrow your search</h3>
            </div>
            <!-- Price Range -->
            <div class="utf-range-slider-item margin-bottom-10">
                <label>Price Range</label>
                <div id="utf-price-range-item" data-min="0" data-max="20000" data-unit="RM " class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                    <input type="text" class="first-slider-value" readonly="readonly" name="pricingrangelow" id="pricingrangelow">
                    <input type="text" class="second-slider-value" readonly="readonly"name="pricingrangehigh" id="pricingrangehigh">
                    <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
                    <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a>
                    <a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div>
                <div class="clearfix"></div>
            </div>
            <!-- Area Range -->
            <div class="utf-range-slider-item margin-top-10 margin-bottom-25">
                <label>Area Range</label>
                <div id="utf-area-range-item" data-min="0" data-max="10000" data-unit="sq ft" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><input type="text" class="first-slider-value"readonly="readonly" name="areabylow" id="areabylow"><input type="text" class="second-slider-value" readonly="readonly" name="areabyhigh" id="areabyhigh"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 0%;"></a><a class="ui-slider-handle ui-state-default ui-corner-all" href="#" style="left: 100%;"></a></div>
                <div class="clearfix"></div>
            </div>
            <h5>Amenities</h5>
            <div class="row with-forms">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="checkboxes one-in-row margin-bottom-10">
                    @foreach($amenities  as $amenity)
                        <div><strong>{{$amenity->name}}</strong></div>
                        @if($amenity->subamenity)
                            @include('customer.includes.subamenity',['subamenity' => $amenity->subamenity])
                        @endif

                    @endforeach
                    </div>
                </div>

            </div>
            <h5>Activities open for</h5>
            <div class="row with-forms">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="checkboxes one-in-row margin-bottom-10">
                        @foreach($activities  as $activity)
                            <div><strong>{{$activity->name}}</strong></div>
                            @if($amenity->subamenity)
                                @include('customer.includes.subactivity',['subactivity' => $activity->subactivity])
                            @endif

                        @endforeach
                    </div>
                </div>

            </div>
            <!-- Row / End -->



            <!-- More Search Options -->
            <a href="#" class="utf-utf-more-search-options-area-button margin-bottom-10 margin-top-20" data-open-title="More Search Option" data-close-title="Less Search Option"></a>

            <!-- More Search Options / End -->

            <button type="submit" class="button fullwidth margin-top-10">Search</button>
        </div>
        <!-- Widget / End -->



        <div class="clearfix"></div>
    </div>
</div>
</form>
