@foreach($subcategories as $child)
    <option value="{{$child->id}}">{{$child->name}}</option>
@endforeach
