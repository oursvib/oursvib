@extends('vendors.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Manage listing</h2>
        <div class="mb-4">




            <a class="btn btn-primary" href="{{ route('vendors.listing.add') }}">Add new listing</a>

        </div>


        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <table id="managelisting" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Listing name</th>
                        <th>Root category</th>
                        <th>Parent category</th>
                        <th>child category</th>
                        <th>Niche category</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($listings as $listing)
                        <tr>
                            <td>{{$listing->title}}</td>

                            <td>{{$listing['rootCategory']['name']}} </td>
                            <td>{{$listing['parentCategory']['name']}} </td>
                            <td>{{$listing['childCategory']['name']}} </td>
                            <td>{{$listing['nicheCategory']['name']}} </td>
                            <td>@if($listing->status=='1')
                                    Approved
                                @else
                                    Pending approval
                                @endif
                            </td>
                            <td>
                                <a href=""><i class="fa fa-eye"></i></a>
                                <a href="vendors/editlisting?id={{$listing->id}}"><i class="fa fa-edit"></i></a>


                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@stop
