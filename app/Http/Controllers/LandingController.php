<?php

    namespace App\Http\Controllers;

    use App\Models\Listing;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Session;

    class LandingController extends Controller
    {
        //
        public function index(){

            if (!Session::has('countryid'))
            {
                Session::put('countryid','148');
            }

            $countries=DB::table('country')->get();
            $countryId=Session::get('countryid');
            $region=DB::table('region')->where('countryId',$countryId)->get();
            $recentlisting=Listing::with('listingimages','listingprice')->inRandomOrder(6)->get();
//            echo '<pre>';
//            print_r($recentlisting);exit;
            return view('customer.pages.home')->with(compact('countries','region','recentlisting'));
        }

        public function setCountry(Request $request){

            $countryid=$request['countryid'];

            if($countryid){
                Session::put('countryid',$countryid);
                return response()->json(['status' => 'success']);
                }else{
                return response()->json(['status' => 'fail']);
            }

        }

    }
