<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $rootcategory=Category::all();
        $listingtype= DB::table('listing_type')->get();
        $billingtype= DB::table('billing_type')->get();
        return view('admin.pages.addlisting',compact('vendors','rootcategory','listingtype','billingtype'));
    }
}
