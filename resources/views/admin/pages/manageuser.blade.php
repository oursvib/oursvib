@extends('admin.layouts.default')
@section('content')
    <div class="content p-4">
        <h2 class="mb-4">Manage user</h2>
        <div class="mb-4">
            <a href="#" class="btn btn-primary manageuser"   data-action="add" data-url="/admin/adduser" data-toggle="modal" data-target="#manageusermodal">Add User</a>
        </div>


        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <table id="manageuser" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email </th>
                        <th>User type</th>
                        <th>Company name</th>
                        <th>Created on</th>
                        <th>Email verified</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ucwords($user->name)}}</td>
                            <td>{{$user->email}} </td>
                            <td>
                                @if($user->role=='1')
                                    Administrator
                                @elseif($user->role=='2')
                                    Vendors
                                @elseif($user->role=='3')
                                    Anchor Vendor
                                @elseif($user->role=='4')
                                    User
                                @endif
                            </td>
                            <td>
                                @if($user->role=='2' || $user->role=='3')
                                    {{ucwords($user->company_name)}}
                                @else
                                    NA
                                @endif
                            </td>
                            <td>{{$user->created_at}} </td>

                            <td>
                                @if($user->email_verified_at)
                                    Yes
                                @else
                                    No
                                @endif
                            </td>
                            <td>
                                @if($user->status_id=='1')
                                    Active
                                @elseif($user->status_id=='2')
                                    Suspended
                                @elseif($user->status_id=='3')
                                    Deleted
                                @endif
                            </td>
                            <td>

                                <a href="#" ><i class="fa fa-edit manageuser" data-action="edit" data-url="/admin/edituser?id={{$user->id}}" data-toggle="modal" data-target="#manageusermodal"></i></a>
                                <a href="#" onclick="deleteUser({{$user->id}})"  ><i class="fa fa-trash"></i></a>
                                @if($user->status_id=='1')
                                <a href="#" onclick="suspendUser({{$user->id}})"  ><i class="fa fa-times-circle"></i></a>
                                @else
                                <a href="#" onclick="activateUser({{$user->id}})"  ><i class="fa fa-check"></i></a>
                                @endif

                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="manageusermodal">
        <div class="modal-dialog">
            <div class="modal-content load_modal_view">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@stop
