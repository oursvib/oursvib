<?php

    namespace App\Http\Controllers;

    use App\Models\Category;
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
            $category=DB::table('categories')->get();
            $countryId=Session::get('countryid');
            $country=DB::table('country')->where('countryId',$countryId)->get();
            $region=DB::table('region')->where('countryId',$countryId)->get();
            $recentlisting=Listing::with('listingimages','listingprice')->inRandomOrder(6)->get();
            $statewise = DB::table('listings')
                ->join('region','listings.state','=','region.regionId')
                ->select('listings.*','region.name', DB::raw('count(id) as total'))
                ->where('country',$countryId)
                ->groupBy('state')
                ->orderBy('total','desc')
                ->limit(6)
                ->get();
//            echo '<pre>';
//            print_r($country);exit;
            return view('customer.pages.home')->with(compact('countries','region','recentlisting','statewise','country','category'));
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


        public function viewListingByCategory(Request $request,$category){
            $categoryid=Category::where('name',$category)->first();
            $countries=DB::table('country')->get();
            $category=DB::table('categories')->get();
            $countryId=Session::get('countryid');
            $country=DB::table('country')->where('countryId',$countryId)->get();
            $region=DB::table('region')->where('countryId',$countryId)->get();
            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity')->where('root_category',$categoryid->id)->paginate(5);
            //print_r(response()->json($categorylisting));exit;
            return view('customer.pages.listing')->with(compact('countries','region','country','category','categorylisting'));
        }

    }
