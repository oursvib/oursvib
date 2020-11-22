<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Listingamenity;
use App\Models\Listingcapacity;
use App\Models\Listingnearby;
use App\Models\Listingprice;
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
        $countries= DB::table('country')->get();
        $months=array('1'=>"Jan",'2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
        $amenities= Amenity::with('subamenity')->where('parent_id','=','0')->get();
        return view('admin.pages.addlisting',compact('vendors','rootcategory','listingtype','billingtype','countries','months','amenities'));
    }

    public function saveListing(Request $request){
        //echo '<pre>';
//        print_r($request->all());
//        print_r($request->file('images'));
//        print_r($request['amenities']);



        foreach ($request->file('images') as $key => $value) {
            $s3 = \Storage::disk('s3');
            $file_name = uniqid() . '.' . $value->getClientOriginalExtension();
            $s3filePath = '/large_image/' . $file_name;
            $s3->put($s3filePath, file_get_contents($value), 'public');
        }

       exit;

           $listingid= Listing::create([
                'vendor_id'=>$request['vendor_id'],
                'root_category'=>$request['root_category'],
                'parent_category'=>$request['parent_category'],
                'child_category'=>$request['child_category'],
                'niche_category'=>$request['niche_category'],
                'listing_type'=>$request['listing_type'],
                'status'=>'2',
                'title'=>$request['title'],
                'description'=>$request['description'],
                'about'=>$request['aboutus'],
                'team'=>$request['team'],
                'address'=>$request['address'],
                'country'=>$request['country'],
                'state'=>$request['state'],
                'city'=>$request['city'],
                'zipcode'=>$request['zipcode'],
                'video'=>$request['videolink'],
            ]);
           if($listingid->id){

               //for nearby locations
               foreach ($request['nearby'] as $nearby){
                   Listingnearby::create([
                       'listing_id'=>$listingid->id,
                       'nearby'=>$nearby['location'],
                       'distance'=>$nearby['distance']
                   ]);
               }

               //for pricing
               Listingprice::create([
                    'listing_id'=>$listingid->id,
                    'billing_type'=>$request['billing_type'],
                    'peak_start'=>$request['peakstart'],
                    'peak_end'=>$request['peakend'],
                    'normal_price'=>$request['normalprice'],
                    'peak_price'=>$request['peakprice']
               ]);

               //for capacity
                Listingcapacity::create([
                    'listing_id'=>$listingid->id,
                    'area_by'=>$request['area_by'],
                    'min_pax'=>$request['min_pax'],
                    'max_pax'=>$request['max_pax'],
                    'seating_pax'=>$request['seating_pax'],
                    'standing_pax'=>$request['standing_pax'],
                    'cooktail_pax'=>$request['cooktail_pax'],
                    'classroom_pax'=>$request['classroom_pax'],
                    'theatre_pax'=>$request['theatre_pax'],
                    'banquet_pax'=>$request['banquet_pax'],
                    'conference_pax'=>$request['conference_pax'],
                    'ushape_pax'=>$request['ushape_pax'],
                ]);

                //for amentities
               for($i=0;$i<count($request['amenities']);$i++){
                   Listingamenity::create([
                       'listing_id'=>$listingid->id,
                       'amenity_id'=>$request['amenities'][$i]
                   ]);
               }

               //for images

           }

        exit;
        request()->validate([
            'images' => 'required',
        ]);
        foreach ($request->file('images') as $key => $value) {
            $imageName = time(). $key . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('images'), $imageName);

        }
       // return response()->json(['success'=>'Images Uploaded Successfully.']);
    }
}
