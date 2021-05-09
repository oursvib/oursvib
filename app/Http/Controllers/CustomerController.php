<?php

namespace App\Http\Controllers;

use App\Mail\newListing;
use App\Mail\orderConfirmation;
use App\Models\Booking;
use App\Models\Listing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
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
                ->where('start_date', '<=', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingfrom'])))
                ->where('end_date', '>=', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingto'])))
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
                ->where('start_date', '<=', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingfrom'])))
                ->where('end_date', '>=', date('Y-m-d H:i:s', strtotime($bookinginfo['bookingto'])))
                ->count();
            $selectbooking=0;
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
                $bookinginformation['listing_id']= $bookinginfo['listing'];
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

    public function initiateBooking(Request $request){

        $vendor_id=$request['vendorid'];
        $listing_id=$request['listing'];
        $starttime=$request['startime'];
        $endtime=$request['endtime'];
        $bookingrefid=$request['bookingrefid'];
        $amountpaid=(string)$request['amountpaid'];
        $selectbooking=Booking::where('listing_id', '=',$listing_id)
            ->where('start_date', '<=', date('Y-m-d H:i:s', strtotime($starttime)))
            ->where('end_date', '>=', date('Y-m-d H:i:s', strtotime($endtime)))
            ->count();

        if($selectbooking==0){
            $booking=Booking::create([
                'vendor_id'=>$vendor_id,
                'listing_id'=>$listing_id,
                'user_id'=>Auth::id(),
                'blockings'=>'0',
                'start_date'=>date('Y-m-d H:i:s', strtotime($starttime)),
                'end_date'=>date('Y-m-d H:i:s', strtotime($endtime)),
                'booking_ref_no'=>$bookingrefid,
                'booking_progress'=>1,
                'amountpaid'=>$amountpaid
            ]);

            if ($booking->id) {
                return response()->json(['status' => 'gothrough', 'message' => $bookingrefid]);
            }else{
                return response()->json(['status' => 'error', 'message' => 'This booking cannot be processed at this moment.']);
            }
        }else{
            return response()->json(['status' => 'error', 'message' => 'This booking cannot be processed at this moment.']);
        }
    }

    public function paymentResponse(Request $request){

        //print_r($request->all());exit;
      //  $bookingdetail=Booking::with('user','vendor','listing')->where('bookings.booking_ref_no','=',$invoiceNo)->where('bookings.user_id','=',Auth::id())->get();
        //echo '<pre>';
        //print_r($bookingdetail[0]->title);
        //exit;
        $countryId=Session::get('countryid');
        $response=$request['response'];
        $result=$request['result'];
        $authCode=$request['authCode'];
        $invoiceNo=$request['invoiceNo'];
        $PAN=$request['PAN'];
        $expiryDate=$request['expiryDate'];
        $amount=$request['amount'];
        $ECI=$request['ECI'];
        $securityKeyRes=$request['securityKeyRes'];
        $hash=$request['hash'];

        $transaction= Transaction::create([
            'response'=>$response,
            'result'=>$result,
            'authCode'=>$authCode,
            'invoiceNo'=>$invoiceNo,
            'PAN'=>$PAN,
            'expiryDate'=>$expiryDate,
            'amount'=>$amount,
            'ECI'=>$ECI,
            'securityKeyRes'=>$securityKeyRes,
            'hash'=>$hash
        ]);
        if($transaction->id) {
            if ($response == 'RJ') {
                $resval = 'Rejected – invalid hash value, fraud related, duplicate transaction ';
            } elseif ($response == 'EP') {
                $resval = 'Rejected – invalid input parameter ';
            } elseif ($response == 'N7') {
                $resval = 'Declined – invalid CVV2 ';
            } elseif ($response == '00') {
                $resval = 'Approved – transaction accepted ';
            } elseif ($response == '01') {
                $resval = 'Declined – refer to card issuer';
            } elseif ($response == '02') {
                $resval = 'Declined – refer to issuer special';
            } elseif ($response == '03') {
                $resval = 'Declined – invalid merchant';
            } elseif ($response == '04') {
                $resval = 'Declined – retain card';
            } elseif ($response == '05') {
                $resval = 'Declined – do not honor';
            } elseif ($response == '06') {
                $resval = 'Declined – error';
            } elseif ($response == '07') {
                $resval = 'Declined – pick-up, fraud';
            } elseif ($response == '12') {
                $resval = 'Declined – invalid';
            } elseif ($response == '13') {
                $resval = 'Declined – invalid amount';
            } elseif ($response == '14') {
                $resval = 'Declined –no card number found';
            } elseif ($response == '15') {
                $resval = 'Declined – invalid issuer';
            } elseif ($response == '19') {
                $resval = 'Declined – system time out';
            } elseif ($response == '21') {
                $resval = 'Declined – no action taken for referral';
            } elseif ($response == '22') {
                $resval = 'Declined – DUKPT error (Derived Unique Key Per Transaction)';
            } elseif ($response == '30') {
                $resval = 'Declined – format error';
            } elseif ($response == '34') {
                $resval = 'Declined – suspected found';
            } elseif ($response == '38') {
                $resval = 'Declined – number of pin tries exceeded';
            } elseif ($response == '41') {
                $resval = 'Declined – pickup, lost';
            } elseif ($response == '43') {
                $resval = 'Declined – pickup, stolen';
            } elseif ($response == '51') {
                $resval = 'Declined – insufficient funds';
            } elseif ($response == '52') {
                $resval = 'Declined – damage/upgrade to gold/erc/name';
            } elseif ($response == '53') {
                $resval = 'Declined – no saving account';
            } elseif ($response == '54') {
                $resval = 'Declined – card expired';
            } elseif ($response == '55') {
                $resval = 'Declined – card invalid pin';
            } elseif ($response == '57') {
                $resval = 'Declined – transaction not permitted by issuer';
            } elseif ($response == '58') {
                $resval = 'Declined – transaction not permitted to acquirer/terminal';
            } elseif ($response == '61') {
                $resval = 'Declined – exceed approval by STIP (Stand-in Processing)';
            } elseif ($response == '62') {
                $resval = 'Declined – restricted card';
            } elseif ($response == '63') {
                $resval = 'Declined – security violation';
            } elseif ($response == '65') {
                $resval = 'Declined – exceed withdraw count limit';
            } elseif ($response == '75') {
                $resval = 'Declined – allowable number of pin tries exceeded';
            } elseif ($response == '76') {
                $resval = 'Declined – invalid/non-existent to account specified';
            } elseif ($response == '77') {
                $resval = 'Declined – invalid/non-existent from account specified';
            } elseif ($response == '78') {
                $resval = 'Declined – invalid/non-existent to account specified';
            } elseif ($response == '82') {
                $resval = 'Declined – invalid CVV';
            } elseif ($response == '84') {
                $resval = 'Declined – invalid authorization life cycle';
            } elseif ($response == '89') {
                $resval = 'Declined – invalid terminal';
            } elseif ($response == '91') {
                $resval = 'Declined – issuer or switch is inoperative';
            } elseif ($response == '93') {
                $resval = 'Declined – transaction cannot be completed, violation of law';
            } elseif ($response == '94') {
                $resval = 'Declined – EDC duplicate settlement';
            } elseif ($response == '96') {
                $resval = 'Declined – system malfunction';
            } elseif ($response == '91') {
                $resval = 'Declined – encryption error';
            } elseif ($response == '98') {
                $resval = 'Declined – SW didn’t get reply from IS';
            } elseif ($response == '99') {
                $resval = 'Rejected – system error';
            } else {
                $resval = 'Non of these';
            }

            if ($response == "00") {
                $bookingdetail=Booking::with('user','vendor','listing')->where('bookings.booking_ref_no','=',$invoiceNo)->where('bookings.user_id','=',Auth::id())->get();
                $adminemail = env('ADMIN_EMAIL', 'karthick.oursvib+admin@gmail.com');
                Mail::to($adminemail)->send(new orderConfirmation($bookingdetail));
                Mail::to($bookingdetail[0]->vendor->email)->send(new orderConfirmation($bookingdetail));
                Session::forget('initialblocking');
                return Redirect::route('ordersuccess')->with('invoiceno',$invoiceNo);
            }else{
                return Redirect::route('orderfailure')->with('invoiceno',$invoiceNo);
            }
        }
        //dd($request);
    }

    public function orderSuccess(){
        $countries=DB::table('country')->get();
        $countryId=Session::get('countryid');
        $country=DB::table('country')->where('countryId',$countryId)->get();
        $states='';$city='';$paxrange='';$bookingframe='';
        return view('customer.pages.ordersuccess',compact('countries','country','states','city','paxrange','bookingframe'));
    }

    public function orderFailure(){
        $countries=DB::table('country')->get();
        $countryId=Session::get('countryid');
        $country=DB::table('country')->where('countryId',$countryId)->get();
        $states='';$city='';$paxrange='';$bookingframe='';
        return view('customer.pages.orderfailure',compact('countries','country','states','city','paxrange','bookingframe'));
    }

    public function dashboard(){
        $countries=DB::table('country')->get();
        $countryId=Session::get('countryid');
        $country=DB::table('country')->where('countryId',$countryId)->get();
        $bookingdetails=Booking::with('user','vendor','listing')->where('bookings.user_id','=',Auth::id())->get();
        $states='';$city='';$paxrange='';$bookingframe='';
        return view('customer.pages.dashboard',compact('countries','country','states','city','paxrange','bookingframe','bookingdetails'));
    }

    public function changePassword(){
        $countries=DB::table('country')->get();
        $countryId=Session::get('countryid');
        $country=DB::table('country')->where('countryId',$countryId)->get();
        $states='';$city='';$paxrange='';$bookingframe='';
        return view('customer.pages.changepassword',compact('countries','country','states','city','paxrange','bookingframe'));

    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not match!');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password successfully changed!');
    }


    public function testpage(){
        return view('customer.pages.testpage');
    }
}
