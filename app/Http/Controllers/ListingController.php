<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Listingamenity;
use App\Models\Listingcapacity;
use App\Models\Listingimage;
use App\Models\Listingnearby;
use App\Models\Listingprice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Session;
class ListingController extends Controller
{
    public function index()
    {
        $listings=Listing::with('rootCategory','parentCategory','childCategory','nicheCategory','user')->whereIn('status',array('1','2'),'or')->get();

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

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }


    public function saveListing(Request $request){
        echo '<pre>';
        print_r($request->all());
//        print_r($request->file('images'));
//        print_r($request['amenities']);
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
                'unique_services'=>$request['unique_services'],
                'stragetic_partner'=>$request['stragetic_patner'],
                'guest_experience'=>$request['guest_experience'],
                'news_highlight'=>$request['news_highlight'],
                'green_innitiative'=>$request['green_innitiative'],
                'star_rating'=>$request['star_rating'],
                'csr_partner'=>$request['csr_partner'],
                'food_partner'=>$request['food_partner'],
                'address'=>$request['address'],
                'country'=>$request['country'],
                'state'=>$request['state'],
                'city'=>$request['city'],
                'zipcode'=>$request['zipcode'],
                'capacity_by'=>$request['capacity_by'],
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
               foreach ($request->file('images') as $key => $value) {
                   $s3 = \Storage::disk('s3');
                   $filenamewithextension = $value->getClientOriginalName();

                   //get filename without extension
                   $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                   //get file extension
                   $extension = $value->getClientOriginalExtension();

                   //filename to store
                   $filenametostore = $filename.'_'.time().'.'.$extension;

                   //thumbnail name
                   $thumbnail = 'thumbnail_'.$filename.'_'.time().'.'.$extension;

                   //large thumbnail name
                   $largethumbnail = 'large_'.$filename.'_'.time().'.'.$extension;

                   //Upload File
                   $value->storeAs('public/listing_images', $filenametostore);
                   $value->storeAs('public/listing_images/thumbnail', $thumbnail);
                   $value->storeAs('public/listing_images/thumbnail', $largethumbnail);

                   //create small thumbnail
                   $thumbnailpath = public_path('storage/listing_images/thumbnail/'.$thumbnail);
                   $this->createThumbnail($thumbnailpath, 160, 160);

                   //create large thumbnail
                   $largethumbnailpath = public_path('storage/listing_images/thumbnail/'.$largethumbnail);
                   $originalpath = public_path('storage/listing_images/'.$filenametostore);

                   $this->createThumbnail($largethumbnailpath, 900, 500);
                   $s3filePathlargeimage = '/large_image/' . $largethumbnail;
                   $s3filePaththumbnailimage = '/thumbnail/' . $thumbnail;
                   $s3filePathorigiinalimage = '/original/' . $filenametostore;

                   $s3->put($s3filePathlargeimage, file_get_contents($largethumbnailpath), 'public');
                   $s3->put($s3filePaththumbnailimage, file_get_contents($thumbnailpath), 'public');
                   $s3->put($s3filePathorigiinalimage, file_get_contents($originalpath), 'public');

                   Listingimage::create([
                       'listing_id'=>$listingid->id,
                       'listing_images'=>$filenametostore
                   ]);

                   unlink($largethumbnailpath);
                   unlink($thumbnailpath);
                   unlink($originalpath);
               }
           }

           if($listingid->id){
               Session::flash('message','New listing added successfully.');
               return response()->json(['status'=>'success','message'=>'New listing added successfully.']);

           }else{
               //Session::flash('message','New listing addition failed.');
               return response()->json(['status'=>'fail','message'=>'New listing addition failed.']);
           }

    }

    public function deletelisting(Request $request){
        $listingid=$request['listingid'];
        if(DB::table('listings')
            ->where('id', $listingid)
            ->update(['status' => '3'])){
            Session::flash('message','Listing deleted successfully.');
            return response()->json(['status'=>'success','message'=>'Listing deleted successfully.']);
        }else{
            return response()->json(['status'=>'fail','message'=>'Listing deleting failed.']);
        }
    }

    public function editListing(Request $request){
        echo $request['id'];

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
        return view('admin.pages.editlisting',compact('vendors','rootcategory','listingtype','billingtype','countries','months','amenities'));
    }
}
