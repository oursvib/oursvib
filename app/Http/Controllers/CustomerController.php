<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Session;
use Illuminate\Support\Str;
class CustomerController extends Controller
{
    //
    public function index(){

        //print_r(Session::get('initialblocking'));
        if(Session::has('initialblocking')){
            return redirect()->route('orderconfirmation');
        }
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


    public function orderConfirmation(){
       // print_r(Session::get('initialblocking'));
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

    public function processPayment(){

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
                $uuid= Str::uuid()->toString();
                $invoicenumber="INVOUR".date('YmdHis');
                $grandtotal=$pricetotal+$additinaladdonsum;
                $grandtotal=str_pad($grandtotal*100 ,12 ,"0", STR_PAD_LEFT);
                $states='';$city='';$paxrange='';$bookingframe='';
                return view('customer.pages.paymentprocess',compact('listings','additinaladdon','bookinginfo','countries','states','city','paxrange','bookingframe','pricetotal','additinaladdonsum','bookinginformation','invoicenumber','grandtotal'));
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function paymentResponse(Request $request){

        $response=$request->get('response');
        $result=$request->get('result');
        $authCode=$request->get('authCode');
        $invoiceNo=$request->get('invoiceNo');
        $PAN=$request->get('PAN');
        $expiryDate=$request->get('expiryDate');
        $amount=$request->get('amount');
        $ECI=$request->get('ECI');
        $securityKeyRes=$request->get('securityKeyRes');
        $hash=$request->get('hash');

        dd($request);
    }
}
