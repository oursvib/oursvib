@extends('admin.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Manage listing</h2>
        <div class="mb-4">




            <a class="btn btn-primary" href="{{ route('admin.listing.add') }}">Add new listing</a>

        </div>



        <div class="card mb-4">
            <div class="card-body">
                <table id="managelisting" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Root category</th>
                        <th>Parent Category</th>
                        <th>Child category</th>
                        <th>Niche category</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listings as $category)
                        <tr>
                            <td>{{$category->rootname}}</td>
                            <td>@if($category->subcatname)
                                    {{$category->subcatname}} @else
                                    NA @endif</td>
                            <td> @if($category->subchildname)
                                    {{$category->subchildname}} @else
                                    NA @endif</td>
                            <td> @if($category->sublowercategory)
                                    {{$category->sublowercategory}} @else
                                    NA @endif</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@stop

