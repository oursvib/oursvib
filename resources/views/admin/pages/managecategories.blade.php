@extends('admin.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Manage category</h2>
        <div class="mb-4">

                <input type="button" class="btn btn-default addcategory" data-action="add" data-url="/admin/addparentcategory" data-toggle="modal" data-target="#addcategorymodel" value="Add parent category">

                <input type="button" class="btn btn-primary addcategory"  data-action="add"  data-toggle="modal" data-url="/admin/addchildcategory" data-target="#addcategorymodel" value="Add child category">

                <input type="button" class="btn btn-secondary addcategory"  data-action="add" data-url="/admin/addnichecategory" data-toggle="modal" data-target="#addcategorymodel" value="Add Niche category">
        </div>



        <div class="card mb-4">
            <div class="card-body">
                <table id="managecategory" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Root category</th>
                        <th>Parent Category</th>
                        <th>Child category</th>
                        <th>Niche category</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
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
    <div class="modal fade" id="addcategorymodel">
        <div class="modal-dialog">
            <div class="modal-content load_modal_view">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop

