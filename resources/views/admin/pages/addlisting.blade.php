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
                    <div class="col-10">
                        &nbsp;
                    </div>
                    <div class="col-2">
                      <a href="{{route('admin.listing.add')}}" class="btn btn-primary">Add new listing</a>
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
                                <h3 class="card-title">Add New Listing</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <div id="addlistingwizard">
                                  <h1> Step 1</h1>
                                  <div>
                                      <div>Select vendor</div>
                                      <div>
                                          <select class="form-control select2" name="vendor_id" id="vendor_id">
                                          @foreach($vendors as $vendor)
                                              <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                          @endforeach
                                          </select>
                                      </div>
                                      <div>Select user</div>
                                      <div>
                                          <select class="select2" name="vendor_id" id="vendor_id1">
                                              @foreach($vendorss as $vendors)
                                                  <option value="{{$vendors->id}}">{{$vendors->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                                  <h1> Step 2</h1>
                                  <div>Second Content</div>

                              </div>
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
