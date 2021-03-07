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
    use Illuminate\Support\Facades\Redirect;
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
            $listingtype = '';
            $bookingframe ='';
            $states ='';
            $city = '';
            $paxrange = '';
            $countryId = Session::get('countryid');
            $country = DB::table('country')->where('countryId', $countryId)->get();
            $region = DB::table('region')->where('countryId', $countryId)->get();
            $pricingrangelow = Listingprice::min('normal_price');
            $pricingrangehigh = Listingprice::max('normal_price');
            $areabylow = Listingcapacity::min('area_by');
            $areabyhigh = Listingcapacity::max('area_by');
            $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();

            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity')->where('root_category',$categoryid->id)->where('country',$countryId)->paginate(2);
            //print_r(response()->json($categorylisting));exit;
            return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricingrangelow', 'pricingrangehigh', 'areabylow', 'areabyhigh', 'activities', 'amenities','categorylisting'));
        }

        public function searchListingold(Request $request){

                if($request->ajax()){
                    $listingtype = $request['listingtype'];
                    $bookingframe = $request['bookingframe'];
                    $states = $request['states'];
                    $city = $request['city'];
                    $paxrange = $request['paxrange'];
                    $categorylisting = Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingcapacity')
                        ->whereHas('listingcapacity', function (Builder $query) use ($paxrange) {
                            $query->where('min_pax', '>=', (int)$paxrange);
                        })
                        ->where('listing_type', $listingtype)
                        ->where('state', $states)
                        ->where('city', $city)
                        ->paginate(3);
                    // dd(DB::getQueryLog());exit;
                    return response()->json($categorylisting);
                }else {

                    $listingtype = $request['listingtype'];
                    $bookingframe = $request['bookingframe'];
                    $states = $request['states'];
                    $city = $request['city'];
                    $paxrange = $request['paxrange'];
                    $countries = DB::table('country')->get();
                    $category = DB::table('categories')->get();
                    $countryId = Session::get('countryid');
                    $country = DB::table('country')->where('countryId', $countryId)->get();
                    $region = DB::table('region')->where('countryId', $countryId)->get();
                    $pricingrangelow = Listingprice::min('normal_price');
                    $pricingrangehigh = Listingprice::max('normal_price');
                    $areabylow = Listingcapacity::min('area_by');
                    $areabyhigh = Listingcapacity::max('area_by');
                    $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
                    $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
                    //DB::enableQueryLog();


                    return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricingrangelow', 'pricingrangehigh', 'areabylow', 'areabyhigh', 'activities', 'amenities','categorylisting'))->withInput($request->all());
                }

        }

        public function searchListing(Request $request){
         //   print_r($request->all());
            $listingtype = $request['listingtype'];
            $bookingframe = $request['bookingframe'];
            $states = $request['states'];
            $city = $request['city'];
            $paxrange = $request['paxrange'];
            if(isset($request['pricingrangelow']) && isset( $request['pricingrangehigh'])){
                $pricingrangelow = $request['pricingrangelow'];
                $pricingrangehigh = $request['pricingrangehigh'];
            }else{
                $pricingrangelow = 'RM 0';
                $pricingrangehigh = 'RM 20,000';
            }

            $pricinglow=(int)str_replace(array('RM',','),'',$pricingrangelow);
            $pricinghigh=(int)str_replace(array('RM',','),'',$pricingrangehigh);
            if(isset($request['areabylow']) && isset( $request['areabyhigh'])){
                $areabylow = $request['areabylow'];
                $areabyhigh = $request['areabyhigh'];
            }else{
                $areabylow = '0 sq ft';
                $areabyhigh = '10000 sq ft';
            }

            $arealow=(int)str_replace(array(' sq ft',','),'',$areabylow);
            $areahigh=(int)str_replace(array(' sq ft',','),'',$areabyhigh);
            if(isset($request['amenity'])){
                $amenityc = $request['amenity'];
            }else{
                $amenityc =array();
            }

            if(isset($request['activity'])){
                $activityc = $request['activity'];
            }else{
                $activityc = array();
            }


            $countries = DB::table('country')->get();
            $category = DB::table('categories')->get();
            $countryId = Session::get('countryid');
            $country = DB::table('country')->where('countryId', $countryId)->get();
            $region = DB::table('region')->where('countryId', $countryId)->get();
            $pricingrangelow = Listingprice::min('normal_price');
            $pricingrangehigh = Listingprice::max('normal_price');
            $areabylow = Listingcapacity::min('area_by');
            $areabyhigh = Listingcapacity::max('area_by');
            $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            DB::enableQueryLog();

            $querys = Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingactivity','listingamenity','listingcapacity');
                if($paxrange!=''){
                    $querys->whereHas('listingcapacity', function (Builder $query) use ($paxrange) {
                        $query->where('min_pax', '>=', (int)$paxrange);
                    });
                }
                if($areabylow!='' && $areabyhigh!='' && $arealow!='0' && $areahigh!='0'){
                    $querys->whereHas('listingcapacity', function (Builder $query) use ($arealow,$areahigh) {
                        $query->whereBetween('area_by',array($arealow,$areahigh));
                    });
                }
                if($pricingrangelow!='' && $pricingrangehigh!='' && $pricinglow!='0' && $pricinghigh!='0'){
                    $querys->whereHas('listingprice', function (Builder $query) use ($pricinglow,$pricinghigh) {
                        $query->whereBetween('normal_price',array($pricinglow,$pricinghigh));
                    });
                }
                if(count($amenityc)>0){
                    $querys->whereHas('listingamenity', function (Builder $query) use ($amenityc) {
                        $query->whereIn('amenity_id',$amenityc);
                    });
                }
                if(count($activityc)>0){
                    $querys->whereHas('listingactivity', function (Builder $query) use ($activityc) {
                        $query->whereIn('activity_id',$activityc);
                    });
                }
                if($countryId!='') {
                    $querys->where('country', $countryId);
                }
                if($listingtype!='') {
                    $querys->where('listing_type', $listingtype);
                }
                if($states!='') {
                    $querys->where('state', $states);
                }
                if($city!='') {
                    $querys->where('city', $city);
                }
            $categorylisting=$querys->paginate(2);
          // dd(DB::getQueryLog());
            return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricinglow', 'pricinghigh', 'arealow', 'areahigh', 'activities', 'amenities','categorylisting','amenityc','activityc'))->withInput($request->all());
        }

        public function search(Request $request)
        {
            $listingtype = '';
            $bookingframe ='';
            $states ='';
            $city = '';
            $paxrange = '';
            $countries = DB::table('country')->get();
            $category = DB::table('categories')->get();
            $countryId = Session::get('countryid');
            $country = DB::table('country')->where('countryId', $countryId)->get();
            $region = DB::table('region')->where('countryId', $countryId)->get();
            $pricingrangelow = Listingprice::min('normal_price');
            $pricingrangehigh = Listingprice::max('normal_price');
            $areabylow = Listingcapacity::min('area_by');
            $areabyhigh = Listingcapacity::max('area_by');
            $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $categorylisting = Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingcapacity')
                ->paginate(10);

    return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricingrangelow', 'pricingrangehigh', 'areabylow', 'areabyhigh', 'activities', 'amenities', 'categorylisting'));
        }

    }

