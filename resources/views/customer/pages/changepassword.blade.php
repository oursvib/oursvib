@extends('customer.layouts.default')
@section('content')
    <div id="wrapper">
        <!-- Titlebar -->
        <div class="parallax titlebar"
             style="background-image: url({{asset('customerfile/images/listings-parallax.jpg')}}); background-attachment: fixed;">
            <div id="titlebar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Change Password</h2>
                            <!-- Breadcrumbs -->
                            <nav id="breadcrumbs">
                                <ul>
                                    <li><a href="/">Home</a></li>
                                    <li>Change password</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container  padding-top-50 padding-bottom-50">
            <div class="row">
                <!-- Sidebar -->
            @include('customer.includes.usersidebar')
            <!-- Sidebar / End -->
                <!-- Property Description -->
                <div class="col-lg-9 col-md-9">
                    <!-- Titlebar -->


                    <div class="property-description">
                        <!-- Description -->
                        <div class="utf-desc-headline-item margin-bottom-0 margin-top-0">
                            <h3>Change password</h3>
                        </div>
                        <div class="container-fluid bg-white padding-top-20 padding-bottom-20">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="post" action="{{ route('updatepassword') }}">
                                            @csrf
                                            <div class="mt-2">
                                                @if(session()->has('error'))
                                                    <span class="alert alert-danger">
                        <strong>{{ session()->get('error') }}</strong>
                    </span>
                                                @endif
                                                @if(session()->has('success'))
                                                    <span class="alert alert-success">
                        <strong>{{ session()->get('success') }}</strong>
                    </span>
                                                @endif
                                            </div>

                                            <div class="mt-2">
                                                <label>Current password</label>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control--sm"
                                                           name="current_password" id="current_password"/>
                                                </div>
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                                @enderror
                                            </div>
                                            <div class="mt-2">
                                                <label>New password</label>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control--sm"
                                                           name="password" id="password"/>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                                @enderror
                                            </div>
                                            <div class="mt-2">
                                                <label>Confirm password</label>
                                                <div class="form-group">
                                                    <input type="password" class="form-control form-control--sm"
                                                           name="password_confirmation" id="password_confirmation"
                                                           />
                                                </div>
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                                @enderror
                                            </div>
                                            <div class="clearfix mt-2">
                                                <button type="submit" class="btn btn--lg w-50 button" id="">Change
                                                    password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="mt-2"></div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Property Description / End -->


        </div>
    </div>
    </div>
    <script>

    </script>
@stop

