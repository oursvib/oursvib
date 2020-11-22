@foreach($subamenity as $subame)
    <div class="col-xs-1 amenity">
    <input type="checkbox" name="amenities[]" class="form-check-input" value="{{$subame->id}}"> {{$subame->name}}
    </div>
@endforeach
