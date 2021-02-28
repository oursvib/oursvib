@foreach($subactivity as $subactive)
    @if($subactive->subactivityitem)
        <h6 style="clear: both">
            {{$subactive->name}}
        </h6>

        <div class="col-md-12">
            @foreach($subactive->subactivityitem as $item)
                <input id="check-{{$item->id}}" type="checkbox" name="check" value="{{$item->id}}">
                <label for="check-{{$item->id}}">{{$item->name}}</label>

            @endforeach
            @endif
        </div>
@endforeach
