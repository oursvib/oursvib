<?php

namespace App\Http\Controllers;

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
            $events[$key]['id']= $booking->id;
        }
        $bookingjson=json_encode($events);
//echo '<pre>';
//print_r($bookingjson);exit;
        return view('admin.pages.bookings',compact('bookings','bookingjson'));
    }

}
