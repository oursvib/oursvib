<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvendorController extends Controller
{
    public function index(){

        return view('avendors.pages.avendorsdashboard');
    }

    public function showLoginForm(){
        return view('avendors.pages.avendorslogin');
    }
}
