<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings=Listing::all();
        return view('admin.pages.managelisting',compact('listings'));
    }

    public function addListing(){
    //    $vendors=User::where('role','2')->where('email_verified_at',)->get();
        $vendors=User::where([
            ['role','=','2'],
            ['email_verified_at','<>','']
        ])->get();
        $vendorss=User::where('role','4')->get();
        return view('admin.pages.addlisting',compact('vendors','vendorss'));
    }
}
