<form name="searchform" id="searchform" method="post" action="{{route('searchlisting')}}">
    @csrf
    <div class="row with-forms">

        <!-- Property Type -->
        <div class="col-md-2">
            <select data-placeholder="Property Type" class="utf-chosen-select-single-item" style="display: none;" name="listingtype" id="listingtype">
                {{--                                    <option value="" disabled="" selected="">Type of Booking</option>--}}
                <option value="1" selected="selected">Instant Booking</option>

            </select>
        </div>
{{--        <div class="col-md-3">--}}
{{--            <div class="utf-main-search-input-item">--}}
{{--                <input type="text" name="bookingframe" id="bookingframe" class="form-control" value="{{$bookingframe}}"/>--}}

{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-3">

            <select name="states" id="states" data-placeholder="Any Status" class="utf-chosen-select-single-item" style="display: none;">
                <option value="" selected="">Filter by state</option>
                @foreach($region as $state)
                    <option value="<?php echo $state->regionId; ?>"  @if ($states == $state->regionId) selected="selected" @endif ><?php echo ucwords($state->name); ?></option>
                @endforeach
            </select>
        </div>
        <!-- Status -->
        <div class="col-md-3" id="citylistdiv">
            <select name="city" id="city" data-placeholder="Any Status"  class="utf-chosen-select-single-item" style="display: none;">
                <option value="" >Filter by city</option>
            </select>
        </div>
        <div class="col-md-2">

            <div class="utf-main-search-input-item">
                <input class="form-control-lg" type="number" @if ($paxrange!='') value="{{$paxrange}}" @else value="1" @endif data-decimals="0" min="1" max="2000000" step="1" name="paxrange" id="paxrange" />

            </div>
        </div>
        <div class="col-md-1">
            <div class="utf-main-search-input-item">
                <button type="submit" class="button" id="searchbutton"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>




    </div>


