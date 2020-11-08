@extends('admin.layouts.default')
@section('content')

    <div class="content p-4">
        <h2 class="mb-4">Add listing</h2>
        <div class="card mb-4">
            <form>
            <div class="card-body">
                <div id="addlistingwizard">
                    <h1> Step 1</h1>
                    <div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select vendor</label>

                                <select class="form-control select2" name="vendor_id" id="vendor_id">
                                    <option value="">select</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->company_name}} - {{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select root category</label>

                                <select class="form-control select2" name="root_category" id="root_category">
                                    <option value="">select</option>
                                    @foreach($rootcategory as $root)
                                        <option value="{{$root->id}}"> {{$root->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select parent category</label>

                                <select class="form-control select2" name="parent_category" id="parent_category">

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select child category</label>

                                <select class="form-control select2" name="child_category" id="child_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select niche category</label>

                                <select class="form-control select2" name="niche_category" id="niche_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Listing type</label>

                                <select class="form-control select2" name="listing_type" id="listing_type">
                                    <option value="">select</option>
                                    @foreach($listingtype as $ltype)
                                        <option value="{{$ltype->id}}"> {{$ltype->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <h1> Step 2</h1>
                    <div>Second Content</div>

                </div>
            </div>
            </form>
        </div>
    </div>

@stop



