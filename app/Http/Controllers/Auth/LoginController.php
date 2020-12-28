<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials = array_add($credentials, 'status_id', '1');
        return $credentials;
    }

    protected function authenticated(Request $request, $user)
    {
        //redirect()->route('home');
        if (Auth::user()->role == '1') {
            //  return redirect()->route('admin.manage.category');
            return response()->json(["redirectto"=>"/admin/category","status"=>"success"]);
        }
        if (Auth::user()->role == '2') {
            //  return redirect()->route('admin.manage.category');
            return response()->json(["redirectto"=>"/vendors","status"=>"success"]);
        }

        if (Auth::user()->role == '3') {
            //   return redirect()->route('avendors.dashboard');
            return response()->json(["redirectto"=>"/avendors","status"=>"success"]);
        }

        if (Auth::user()->role == '4') {
            //  return redirect()->route('customer.dashboard');
            return response()->json(["redirectto"=>"/customer","status"=>"success"]);
        }
    }
}
