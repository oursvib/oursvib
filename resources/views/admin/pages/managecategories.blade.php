@extends('admin.layouts.default')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1>Manage Category</h1>--}}
{{--                    </div>--}}
{{--                  @include('admin.includes.breadcrumb')--}}
{{--                </div>--}}
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        &nbsp;
                    </div>
                    <div class="col-2">
                        <input type="button" class="btn btn-default addcategory" data-action="add" data-url="/admin/addparentcategory" data-toggle="modal" data-target="#addcategorymodel" value="Add parent category">
                    </div>
                    <div class="col-2">
                        <input type="button" class="btn btn-primary addcategory"  data-action="add"  data-toggle="modal" data-url="/admin/addchildcategory" data-target="#addcategorymodel" value="Add child category">
                    </div>
                    <div class="col-2">
                        <input type="button" class="btn btn-secondary addcategory"  data-action="add" data-url="/admin/addnichecategory" data-toggle="modal" data-target="#addcategorymodel" value="Add Niche category">
                    </div>

                </div>
            </div>
        </section>
        <div class="row"><div>&nbsp;</div></div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Category</h3>
                            </div>
                            <!-- /.card-header -->
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
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
