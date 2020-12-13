@foreach($subactivity as $subactive)
    @if($subactive->subactivityitem)
    <h6 style="clear: both">
         {{$subactive->name}}
    </h6>

    <div class="col-md-12">
        @foreach($subactive->subactivityitem as $item)
            <div class="col-md-3" style="float: left">
                <input type="checkbox" name="activity[]" class="form-check-input" value="{{$item->id}}" @if($listinginfo->listingactivity->pluck('activity_id')->contains($item->id)) checked="checked" @endif> {{$item->name}}
            </div>
        @endforeach
    @endif
    </div>
@endforeach
