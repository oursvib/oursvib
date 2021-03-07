@foreach($subactivity as $subactive)
    @if($subactive->subactivityitem)
        <h6 style="clear: both">
            {{$subactive->name}}
        </h6>

        <div class="col-md-12">
            @foreach($subactive->subactivityitem as $item)
                <input id="activity-{{$item->id}}" type="checkbox" name="activity[]" value="{{$item->id}}"  @if(in_array($item->id,$activityc)) checked @endif>
                <label for="activity-{{$item->id}}">{{$item->name}}</label>

            @endforeach
            @endif
        </div>
@endforeach
