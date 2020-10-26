<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendorsController extends Controller
{

    public function index(){

        return view('vendors.pages.vendorsdashboard');
    }

    public function showLoginForm(){
        return view('vendors.pages.vendorslogin');
    }
}
