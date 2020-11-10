@extends('admin.layouts.default')
@section('content')

    <div class="content p-4">
        <h2 class="mb-4">Add listing</h2>
        <div class="card mb-4">

            <div class="card-body">
                <div>
                    <form id="addlistingwizard" action="#">
                    <h3> Step 1</h3>
                    <fieldset>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select vendor</label>

                                <select class="form-control select2 required" name="vendor_id" id="vendor_id">
                                    <option value="">select</option>
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}">{{$vendor->company_name}} - {{$vendor->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select root category</label>

                                <select class="form-control select2 required" name="root_category" id="root_category">
                                    <option value="">select</option>
                                    @foreach($rootcategory as $root)
                                        <option value="{{$root->id}}"> {{$root->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select parent category</label>

                                <select class="form-control select2 required" name="parent_category" id="parent_category">

                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Select child category</label>

                                <select class="form-control select2 required" name="child_category" id="child_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Select niche category</label>

                                <select class="form-control select2 required" name="niche_category" id="niche_category">
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Listing type</label>

                                <select class="form-control select2 required" name="listing_type" id="listing_type">
                                    <option value="">select</option>
                                    @foreach($listingtype as $ltype)
                                        <option value="{{$ltype->id}}"> {{$ltype->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Title</label>

                                <input type="text" name="title" id="title" class="form-control required">
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Description</label>

                                <textarea name="description"  id="description" class="form-control required"></textarea>
                            </div>

                        </div>
                    </fieldset>
                    <h3> Step 2</h3>
                    <fieldset>Second Content</fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>

@stop



