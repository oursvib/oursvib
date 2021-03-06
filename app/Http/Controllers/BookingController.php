<?php

namespace App\Http\Controllers;

use App\Models\User;
use Acaronlex\LaravelCalendar\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    //
    public function index(){
        $events = [];
        $bookings=DB::table('bookings')
            ->join('listings','bookings.listing_id','=','listings.id')
            ->join('users','users.id','=','bookings.vendor_id')
            ->select("bookings.id as bookingid","bookings.*","listings.*","users.company_name")
            ->get();

        foreach ($bookings as $key=>$booking) {
//            $events[] = Calendar::event(
//                $booking->title.' - '.$booking->company_name, //event title
//                true, //full day event?
//                new \DateTime($booking->start_date), //start time (you can also use Carbon instead of DateTime)
//                new \DateTime($booking->end_date), //end time (you can also use Carbon instead of DateTime)
//                $booking->id//optionally, you can specify an event ID
//            );
            $events[$key]['title']=$booking->title.' - '.$booking->company_name;
            $events[$key]['start']=$booking->start_date;
            $events[$key]['end']= $booking->end_date;
            $events[$key]['id']= $booking->bookingid;
            $events[$key]['bookingrefno']= $booking->booking_ref_no;
            if($booking->vendor_id==$booking->user_id && $booking->blockings=='1'){
                $events[$key]['blockings']= 'Yes';
                $events[$key]['classNames']= 'block';

            }else{
                $events[$key]['blockings']= 'No';
                $events[$key]['classNames']= 'userbooking';
            }

        }
        $bookingjson=json_encode($events);
//echo '<pre>';
//print_r($bookingjson);exit;
        return view('admin.pages.bookings',compact('bookings','bookingjson'));
    }

    public function editBooking(Request $request){

   		 $booingid=$request['bookingid'];
   		 $bookingrefno=$request['bookingrefno'];
   		 return view('admin.pages.bookingedit');
    }

     public function viewBooking(Request $request){

   		 $bookingid=$request['bookingid'];
   		 $bookingrefno=$request['bookingrefno'];
   		 $bookingdetails=DB::table('bookings')
            ->join('listings','bookings.listing_id','=','listings.id')
            ->join('users as vendors','vendors.id','=','bookings.vendor_id')
            ->join('users as user','user.id','=','bookings.user_id')
            ->select("bookings.id as bookingid","bookings.*","listings.*","vendors.company_name","vendors.email as vendoremail","user.name as bookedusername","user.email as bookeduseremail","bookings.created_at as bookingdate")
            ->where('bookings.id','=',$bookingid)
            ->where('bookings.booking_ref_no','=',$bookingrefno)
            ->first();

   		 return view('admin.pages.bookingview')->with(compact('bookingdetails'));
    }

		public function addBooking(Request $request){
			  $vendors= User::where('role', '2')->whereNotNull('email_verified_at')->get();
   		  return view('admin.pages.bookingadd')->with(compact('vendors'));
    }
}
