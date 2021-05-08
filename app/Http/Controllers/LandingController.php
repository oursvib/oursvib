<?php

    namespace App\Http\Controllers;

    use Acaronlex\LaravelCalendar\Calendar;
    use App\Models\Activity;
    use App\Models\Amenity;
    use App\Models\Booking;
    use App\Models\Category;
    use App\Models\Listing;
    use App\Models\Listingamenity;
    use App\Models\Listingcapacity;
    use App\Models\Listingprice;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use \Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\Redirect;
    use Session;
    use Carbon\Carbon;
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
            $recentlisting=Listing::with('listingimages','listingprice')->where('status','1')->inRandomOrder(6)->get();
            $statewise = DB::table('listings')
                ->join('region','listings.state','=','region.regionId')
                ->select('listings.*','region.name', DB::raw('count(id) as total'))
                ->where('country',$countryId)
                ->where('status','1')
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
            $pricingrangelow = 'RM 0';
            $pricingrangehigh = 'RM 20,000';
            $pricinglow=(int)str_replace(array('RM',','),'',$pricingrangelow);
            $pricinghigh=(int)str_replace(array('RM',','),'',$pricingrangehigh);
            $areabylow = '0 sq ft';
            $areabyhigh = '10000 sq ft';
            $arealow=(int)str_replace(array(' sq ft',','),'',$areabylow);
            $areahigh=(int)str_replace(array(' sq ft',','),'',$areabyhigh);
            $amenityc =array();
            $activityc =array();
            $countryId = Session::get('countryid');
            $country = DB::table('country')->where('countryId', $countryId)->get();
            $region = DB::table('region')->where('countryId', $countryId)->get();
            $pricingrangelow = Listingprice::min('normal_price');
            $pricingrangehigh = Listingprice::max('normal_price');
            $areabylow = Listingcapacity::min('area_by');
            $areabyhigh = Listingcapacity::max('area_by');
            $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();

            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity')->where('root_category',$categoryid->id)->where('country',$countryId)->where('status','1')->paginate(2);
            //print_r(response()->json($categorylisting));exit;
            //return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricingrangelow', 'pricingrangehigh', 'areabylow', 'areabyhigh', 'activities', 'amenities','categorylisting'));
            return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricinglow', 'pricinghigh', 'arealow', 'areahigh', 'activities', 'amenities','categorylisting','amenityc','activityc'))->withInput($request->all());
        }

        public function viewListingByState(Request $request,$state){

            $countries=DB::table('country')->get();
            $category=DB::table('categories')->get();
            $listingtype = '';
            $bookingframe ='';
            $states ='';
            $city = '';
            $paxrange = '';
            $pricingrangelow = 'RM 0';
            $pricingrangehigh = 'RM 20,000';
            $pricinglow=(int)str_replace(array('RM',','),'',$pricingrangelow);
            $pricinghigh=(int)str_replace(array('RM',','),'',$pricingrangehigh);
            $areabylow = '0 sq ft';
            $areabyhigh = '10000 sq ft';
            $arealow=(int)str_replace(array(' sq ft',','),'',$areabylow);
            $areahigh=(int)str_replace(array(' sq ft',','),'',$areabyhigh);
            $amenityc =array();
            $activityc =array();
            $countryId = Session::get('countryid');
            $country = DB::table('country')->where('countryId', $countryId)->get();
            $region = DB::table('region')->where('countryId', $countryId)->get();
            $pricingrangelow = Listingprice::min('normal_price');
            $pricingrangehigh = Listingprice::max('normal_price');
            $areabylow = Listingcapacity::min('area_by');
            $areabyhigh = Listingcapacity::max('area_by');
            $amenities = Amenity::with('subamenity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();
            $activities = Activity::with('subactivity')->where('parent_id', '0')->orderBy('name', 'Asc')->get();

            $categorylisting=Listing::with('listingimages','listingprice','listingcountry','listingstate','listingcity')->where('country',$countryId)->where('state',$state)->where('status','1')->paginate(2);
            //print_r(response()->json($categorylisting));exit;
            //return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricingrangelow', 'pricingrangehigh', 'areabylow', 'areabyhigh', 'activities', 'amenities','categorylisting'));
            return view('customer.pages.listing')->with(compact('countries', 'region', 'country', 'category', 'states', 'city', 'paxrange', 'bookingframe', 'pricinglow', 'pricinghigh', 'arealow', 'areahigh', 'activities', 'amenities','categorylisting','amenityc','activityc'))->withInput($request->all());
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
          //  print_r($request->all());
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
            //DB::enableQueryLog();

            $querys = Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingactivity','listingamenity','listingcapacity');
                if($paxrange!=''){
                    $querys->whereHas('listingcapacity', function (Builder $query) use ($paxrange) {
                        $query->where('min_pax', '>=', (int)$paxrange);
                    });
                }
                if($areabylow!='' && $areabyhigh!=''  && $areahigh!='0'){
                    $querys->whereHas('listingcapacity', function (Builder $query) use ($arealow,$areahigh) {
                        $query->whereBetween('area_by',array($arealow,$areahigh));
                    });
                }
                if($pricingrangelow!='' && $pricingrangehigh!=''  && $pricinghigh!='0'){
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

        public function viewListingDetails($listingid,$from='',$to=''){
            $countryId = Session::get('countryid');
            $countries = DB::table('country')->get();
            $states ='';
            $city = '';
            $listingdetails=Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingcapacity','listingamenity','listingactivity')->findOrFail($listingid);
//            echo '<pre>';
            $additinaladdon=DB::table('listing_additional as a')->select('b.name','a.*')->join('additonal_fee as b','b.id','=','a.additional_id')->where('a.listing_id',$listingdetails->id)->whereIn('a.type',array('1','2'))->orderBy('type','desc')->get();
            if(Session::has('initialblocking')){
                $bookinginfo= $bookinginfo=Session::get('initialblocking');
                $from=date('Y-m-d H:i', strtotime($bookinginfo['bookingfrom']));
                $to=date('Y-m-d H:i', strtotime($bookinginfo['bookingto']));
            }else{
                $from='';$to='';
            }
            $amenities=$listingdetails->listingamenity->pluck('amenity_id')->toArray();
            $activities=$listingdetails->listingactivity->pluck('activity_id')->toArray();
            $amenity=DB::table('amenities')->whereIn('id',$amenities)->get();
            $activity=DB::table('activity')->whereIn('id',$activities)->get();
            //print_r($amenity);exit;
//exit;

            return view('customer.pages.listingdetail')->with(compact('countries','states','city','listingdetails','amenity','activity','additinaladdon','from','to'));
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

        public function checkAvailability(Request $request){
            $startdate=$request['bookingfrom'];
            $enddate=$request['bookingto'];
            $listing=$request['listing'];
            // chekcing from and to


            if($startdate!='' && $enddate!='') {
                $from=strtotime($startdate);
                $to=strtotime($enddate);
                if ($to < $from) {
                    return response()->json(['status' => 'failure', 'message' => 'Booking To date cannot be less than Booking From date']);
                }
                if ($from == $to) {
                    return response()->json(['status' => 'failure', 'message' => 'Booking To date and Booking From date cannot be same']);
                }

                if($from<$to){
                    $selectbooking=Booking::where('listing_id', '=', $request['listing'])
                        ->where('start_date', '<', date('Y-m-d H:i:s', strtotime($request['bookingfrom'])))
                        ->where('end_date', '>', date('Y-m-d H:i:s', strtotime($request['bookingto'])))
                        ->count();
                    if($selectbooking==0){
                         $additinaladdon=DB::table('listing_additional as a')->select('b.name','a.*')->join('additonal_fee as b','b.id','=','a.additional_id')->where('a.listing_id',$request['listing'])->whereIn('a.type',array('1','2'))->orderBy('type','desc')->count();
                        if($additinaladdon){
                            return response()->json(['status' => 'successaddon', 'message' => 'Wow,Listing is available please feel free to check additional addon  and  click on proceed with booking to go through the booking process.']);
                        }else{
                            return response()->json(['status' => 'successnoaddon', 'message' => 'Wow,Listing is available please feel free to check additional addon  and  click on proceed with booking to go through the booking process.']);
                        }

                    }else{
                        return response()->json(['status' => 'failure', 'message' =>'This listing is not available for booking over the mentioned time frame, please try booking at some other dates or look for a different listing.']);
                    }

                }
            }else{
                return response()->json(['status' => 'failure', 'message' => 'Booking From date or Booking To date cannot be empty' ]);
            }
        }

        public function checkBookingSlot($fromdate,$todate,$listing){
            $selectbooking=Booking::where('listing_id', '=',$listing)
                ->where('start_date', '<', date('Y-m-d H:i:s', strtotime($fromdate)))
                ->where('end_date', '>', date('Y-m-d H:i:s', strtotime($todate)))
                ->count();
            return $selectbooking;
        }

        public function initialBlocking(Request $request){
            Session::put('initialblocking',$request->all());
           if(Session::has('initialblocking')){
               return response()->json(['status' => 'success', 'message' => 'previewbooking']);
           }else{
               return response()->json(['status' => 'failure', 'message' => 'This listing is not available for booking over the mentioned time frame, please try booking at some other dates or look for a different listing.']);
           }
        }

        public function previewBooking(){
            //print_r(Session::get('initialblocking'));exit;
            if(Session::has('initialblocking')){
                $bookinginfo=Session::get('initialblocking');
                //print_r($bookinginfo);
                $selectbooking=Booking::where('listing_id', '=',$bookinginfo['listing'])
                    ->where('start_date', '<', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingfrom'])))
                    ->where('end_date', '>', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingto'])))
                    ->count();
               if($selectbooking==0){
                   $countries=DB::table('country')->get();
                   $category=DB::table('categories')->get();
                   $countryId=Session::get('countryid');
                   $country=DB::table('country')->where('countryId',$countryId)->get();
                    $listings=Listing::with('listingimages', 'listingprice', 'listingcountry', 'listingstate', 'listingcity', 'listingcapacity','listingimages')->findorfail($bookinginfo['listing']);
                    //echo '<pre>';print_r($listings);exit;
                    $additinaladdon=DB::table('listing_additional as a')->select('b.name','a.*')->join('additonal_fee as b','b.id','=','a.additional_id')->where('a.listing_id',$bookinginfo['listing'])->whereIn('a.type',array('1','2'))->whereIn('a.id',$bookinginfo['additionaladdon'])->orderBy('type','desc')->get();
                     $additinaladdonsum=DB::table('listing_additional as a')->select('b.name','a.*')->join('additonal_fee as b','b.id','=','a.additional_id')->where('a.listing_id',$bookinginfo['listing'])->whereIn('a.type',array('1','2'))->whereIn('a.id',$bookinginfo['additionaladdon'])->orderBy('type','desc')->sum('amount');
                    $bookinginformation['startingtime']= date('d-m-Y H:i',strtotime($bookinginfo['bookingfrom']));
                    $bookinginformation['endtime']= date('d-m-Y H:i',strtotime($bookinginfo['bookingto']));
                    //echo $bookinginfo['bookingfrom'];echo $bookinginfo['bookingto'];exit;
//                   $date_a = Carbon::parse($bookinginfo['bookingfrom']);
//                   $date_b = Carbon::parse($bookinginfo['bookingto']);
                   $d2=strtotime($bookinginfo['bookingto']);
                   $d1=strtotime($bookinginfo['bookingfrom']);
                   $peakpricestart=$listings->listingprice->pluck('peak_start')->first();
                   $peakpriceend=$listings->listingprice->pluck('peak_end')->first();
                    $startmonth= date('n',strtotime($bookinginfo['bookingfrom']));
                    $endmonth= date('n',strtotime($bookinginfo['bookingto']));
                     $timeinmin=((($d2-$d1)/60)/60);

//                   $timeinmin=136;
//                    $startmonth=2;
//                   $endmonth=4;
                   if($startmonth>=$peakpricestart && $endmonth<=$peakpriceend){
                       if($timeinmin<12){
                           $pricetotal=$timeinmin*$listings->listingprice->where('billing_type','1')->pluck('peak_price')->first();
                       }elseif($timeinmin>=12 && $timeinmin<24){
                           $remaining=$timeinmin-12;
                           $price1=1*$listings->listingprice->where('billing_type','2')->pluck('peak_price')->first();
                           $price2=$remaining*$listings->listingprice->where('billing_type','1')->pluck('peak_price')->first();
                           $pricetotal=$price1+$price2;
                       }else{
                           $splittime = $timeinmin % 24;
                           $days = ($timeinmin - $splittime) / 24;
                           $price1=$days*$listings->listingprice->where('billing_type','3')->pluck('peak_price')->first();
                           if($splittime<12){
                               $price2=$timeinmin*$listings->listingprice->where('billing_type','1')->pluck('peak_price')->first();
                           }elseif($splittime>=12 && $splittime<24){
                               $remainingsub=$splittime-12;
                               $price3=1*$listings->listingprice->where('billing_type','2')->pluck('peak_price')->first();
                               $price4=$remainingsub*$listings->listingprice->where('billing_type','1')->pluck('peak_price')->first();
                               $price2=$price3+$price4;
                           }
                           $pricetotal=$price1+$price2;
                        }
                   }else{
                        if($timeinmin<12){
                            $pricetotal=$timeinmin*$listings->listingprice->where('billing_type','1')->pluck('normal_price')->first();
                        }elseif($timeinmin>=12 && $timeinmin<24){
                            $remaining=$timeinmin-12;
                            $price1=1*$listings->listingprice->where('billing_type','2')->pluck('normal_price')->first();
                            $price2=$remaining*$listings->listingprice->where('billing_type','1')->pluck('normal_price')->first();
                            $pricetotal=$price1+$price2;
                        }else{
                            $splittime = $timeinmin % 24;
                            $days = ($timeinmin - $splittime) / 24;
                            $price1=$days*$listings->listingprice->where('billing_type','3')->pluck('normal_price')->first();
                            if($splittime<12){
                                $price2=$timeinmin*$listings->listingprice->where('billing_type','1')->pluck('normal_price')->first();
                            }elseif($splittime>=12 && $splittime<24){
                                $remainingsub=$splittime-12;
                                $price3=1*$listings->listingprice->where('billing_type','2')->pluck('normal_price')->first();
                                $price4=$remainingsub*$listings->listingprice->where('billing_type','1')->pluck('normal_price')->first();
                                $price2=$price3+$price4;
                            }
                            $pricetotal=$price1+$price2;
                        }
                   }



                   $states='';$city='';$paxrange='';$bookingframe='';
                    return view('customer.pages.previewbooking',compact('listings','additinaladdon','bookinginfo','countries','states','city','paxrange','bookingframe','pricetotal','additinaladdonsum','bookinginformation'));
               }else{
                   return redirect('/');
               }
            }else{
                return redirect('/');
            }
        }
    }

