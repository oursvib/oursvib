<?php

    namespace App\Http\Controllers;

    use Acaronlex\LaravelCalendar\Calendar;
    use App\Models\Activity;
    use App\Models\Amenity;
    use App\Models\Category;
    use App\Models\Listing;
    use App\Models\Listingcapacity;
    use App\Models\Listingprice;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
   use \Illuminate\Database\Eloquent\Builder;
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
            $states='';$city='';$paxrange='';$bookingframe='';
            return view('customer.pages.home')->with(compact('countries','region','recentlisting','statewise','country','category','states','city','paxrange','bookingframe'));
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
            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity')->where('root_category',$categoryid->id)->paginate(10);
            //print_r(response()->json($categorylisting));exit;
            return view('customer.pages.listing')->with(compact('countries','region','country','category','categorylisting'));
        }

        public function searchListing(Request $request){

            $listingtype=$request['listingtype'];
            $bookingframe=$request['bookingframe'];
            $states=$request['states'];
            $city=$request['city'];
            $paxrange=$request['paxrange'];
            $countries=DB::table('country')->get();
            $category=DB::table('categories')->get();
            $countryId=Session::get('countryid');
            $country=DB::table('country')->where('countryId',$countryId)->get();
            $region=DB::table('region')->where('countryId',$countryId)->get();
            $pricingrangelow=Listingprice::min('normal_price');
            $pricingrangehigh=Listingprice::max('normal_price');
            $areabylow=Listingcapacity::min('area_by');
            $areabyhigh=Listingcapacity::max('area_by');
            $amenities=Amenity::with('subamenity')->where('parent_id','0')->orderBy('name','Asc')->get();
            $activities=Activity::with('subactivity')->where('parent_id','0')->orderBy('name','Asc')->get();
            //echo '<pre>';
            //print_r($activities);exit;
         //   DB::enableQueryLog();
            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity','listingcapacity')

                ->whereHas('listingcapacity', function (Builder $query) use($paxrange) {
                    $query->where('min_pax', '>=',(int)$paxrange );
                })
                ->where('listing_type',$listingtype)
                ->where('state',$states)
                ->where('city',$city)
                ->paginate(10);
           // dd(DB::getQueryLog());exit;
          //  print_r(response()->json($categorylisting));exit;
            return view('customer.pages.listing')->with(compact('countries','region','country','category','categorylisting','states','city','paxrange','bookingframe','pricingrangelow','pricingrangehigh','areabylow','areabyhigh','activities','amenities'));
        }




    }

