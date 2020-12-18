@foreach($subamenity as $subame)
    <div class="col-xs-1 amenity">
    <input type="checkbox" name="amenities[]" class="form-check-input" value="{{$subame->id}}" @if($listinginfo->listingamenity->pluck('amenity_id')->contains($subame->id)) checked="checked" @endif> {{$subame->name}}
    </div>
@endforeach
