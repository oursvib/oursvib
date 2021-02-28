@foreach($subamenity as $subame)
    <input id="check-{{$subame->id}}" type="checkbox" name="check" value="{{$subame->id}}">
    <label for="check-{{$subame->id}}">{{$subame->name}}</label>
@endforeach
