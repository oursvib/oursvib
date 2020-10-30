<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return view('home');
        // echo Auth::user()->role ;exit;
        if (Auth::user()->role == '1') {
            return redirect()->route('admin.manage.category');
        }

        if (Auth::user()->role == '2') {
            return redirect()->route('vendors.dashboard');
        }

        if (Auth::user()->role == '3') {
            return redirect()->route('avendors.dashboard');
        }

        if (Auth::user()->role == '4') {
            return redirect()->route('customer.dashboard');
        }

    }
}
