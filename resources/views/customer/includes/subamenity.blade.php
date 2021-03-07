
@foreach($subamenity as $subame)
    <input id="amenity-{{$subame->id}}" type="checkbox" name="amenity[]" value="{{$subame->id}}" @if(in_array($subame->id,$amenityc)) checked @endif >
    <label for="amenity-{{$subame->id}}">{{$subame->name}}</label>
@endforeach
