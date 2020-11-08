@extends('admin.layouts.login')
@section('content')
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
            <h1 class="text-center mb-4">Oursvib Admin</h1>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{route('login')}}" id="login-form">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control"  name="email" placeholder="Email" value="{{ old('email') }}">

                            @error('email')
                            <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            @error('password')
                            <span class="error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

{{--                        <div class="form-check mb-3">--}}
{{--                            <label class="form-check-label">--}}
{{--                                <input type="checkbox" name="remember" class="form-check-input">--}}
{{--                                Remember Me--}}
{{--                            </label>--}}
{{--                        </div>--}}

                        <div class="row">
                            <div class="col pr-2">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                            </div>
{{--                            <div class="col pl-2">--}}
{{--                                <a class="btn btn-block btn-link" href="#">Forgot Password</a>--}}
{{--                            </div>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
