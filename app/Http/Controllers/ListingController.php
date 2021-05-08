<?php

namespace App\Http\Controllers;

use App\Mail\listingApproved;
use App\Mail\listingUnapproved;
use App\Mail\newListing;
use App\Models\Activity;
use App\Models\Amenity;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Listingactivity;
use App\Models\Listingadditional;
use App\Models\Listingamenity;
use App\Models\Listingcapacity;
use App\Models\Listingimage;
use App\Models\Listingnearby;
use App\Models\Listingprice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Image;
use Session;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('rootCategory', 'parentCategory', 'childCategory', 'nicheCategory', 'user')->whereIn('status', array('1', '2'), 'or')->get();

        return view('admin.pages.managelisting', compact('listings'));
    }

    public function addListing()
    {
        $vendors        = User::where('role', '2')->whereNotNull('email_verified_at')->get();
        $rootcategory   = Category::all();
        $listingtype    = DB::table('listing_type')->get();
        $billingtype    = DB::table('billing_type')->get();
        $countries      = DB::table('country')->get();
        $months         = array('1' => "Jan", '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
        $amenities      = Amenity::with('subamenity')->where('parent_id', '=', '0')->get();
        $activities     = Activity::with('subactivity')->where('parent_id', '=', '0')->get();
        $additionalfees = DB::table('additonal_fee')->get();
        //  print_r($activity);
        //print_r(json_encode($activity));exit;
        return view('admin.pages.addlisting', compact('vendors', 'rootcategory', 'listingtype', 'billingtype', 'countries', 'months', 'amenities', 'activities', 'additionalfees'));
    }

    public function createThumbnail($path, $width, $height,$hint='soft')
    {
        if($hint=="soft") {
            $img = Image::make($path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }else{
            $img = Image::make($path)->resize($width, $height);
        }
        $img->save($path);
    }

    public function saveListing(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        //  //exit;
        //        print_r($request->file('images'));
        //        print_r($request['amenities']);
        //exit;

        $listingid = Listing::create([
            'vendor_id'         => $request['vendor_id'],
            'root_category'     => $request['root_category'],
            'parent_category'   => $request['parent_category'],
            'child_category'    => $request['child_category'],
            'niche_category'    => $request['niche_category'],
            'listing_type'      => $request['listing_type'],
            'status'            => '2',
            'title'             => $request['title'],
            'description'       => $request['description'],
            'about'             => $request['aboutus'],
            'team'              => $request['team'],
            'unique_services'   => $request['unique_services'],
            'stragetic_partner' => $request['stragetic_patner'],
            'guest_experience'  => $request['guest_experience'],
            'news_highlight'    => $request['news_highlight'],
            'green_innitiative' => $request['green_innitiative'],
            'star_rating'       => $request['star_rating'],
            'csr_partner'       => $request['csr_partner'],
            'food_partner'      => $request['food_partner'],
            'address'           => $request['address'],
            'country'           => $request['country'],
            'state'             => $request['state'],
            'city'              => $request['city'],
            'zipcode'           => $request['zipcode'],
            'capacity_by'       => $request['capacity_by'],
            'video'             => $request['videolink'],
            'dvrlink'             => $request['dvrlink'],
        ]);
        if ($listingid->id) {

            //for nearby locations
            foreach ($request['nearby'] as $nearby) {
                Listingnearby::create([
                    'listing_id' => $listingid->id,
                    'nearby'     => $nearby['location'],
                    'distance'   => $nearby['distance'],
                ]);
            }

            //for pricing
            foreach ($request['price'] as $price) {
                Listingprice::create([
                    'listing_id'   => $listingid->id,
                    'billing_type' => $price['billing_type'],
                    'peak_start'   => $price['peakstart'],
                    'peak_end'     => $price['peakend'],
                    'normal_price' => $price['normalprice'],
                    'peak_price'   => $price['peakprice'],
                ]);
            }

            //for capacity
            Listingcapacity::create([
                'listing_id'              => $listingid->id,
                'area_by'                 => $request['area_by'],
                'min_pax'                 => $request['min_pax'],
                'max_pax'                 => $request['max_pax'],
                'seating_pax'             => $request['seating_pax'],
                'standing_pax'            => $request['standing_pax'],
                'cooktail_pax'            => $request['cooktail_pax'],
                'classroom_pax'           => $request['classroom_pax'],
                'theatre_pax'             => $request['theatre_pax'],
                'banquet_pax'             => $request['banquet_pax'],
                'conference_pax'          => $request['conference_pax'],
                'ushape_pax'              => $request['ushape_pax'],
                'height'                  => $request['height'],
                'length'                  => $request['length'],
                'width'                   => $request['width'],
                'screen_size'             => $request['screen_size'],
                'panel_size'              => $request['panel_size'],
                'letter_height'           => $request['letter_height'],
                'best_impact'             => $request['best_impact'],
                'max_readable_distance'   => $request['max_readable_distance'],
                'floor_signage_dimension' => $request['floor_signage_dimension'],
            ]);

            //for amentities
            for ($i = 0; $i < count($request['amenities']); $i++) {
                Listingamenity::create([
                    'listing_id' => $listingid->id,
                    'amenity_id' => $request['amenities'][$i],
                ]);
            }

            //for additional fee
            foreach ($request['additional_fee'] as $additionalfee) {
                Listingadditional::create([
                    'listing_id'    => $listingid->id,
                    'additional_id' => $additionalfee['additional_id'],
                    'type'          => $additionalfee['type'],
                    'amount'        => $additionalfee['amount'],
                ]);
            }

            //for activites
            for ($i = 0; $i < count($request['activity']); $i++) {
                Listingactivity::create([
                    'listing_id'  => $listingid->id,
                    'activity_id' => $request['activity'][$i],
                ]);
            }

            //for images
            foreach ($request->file('images') as $key => $value) {
               // $s3                    = \Storage::disk('s3');
                $filenamewithextension = $value->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $value->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . time() . '.' . $extension;

                //thumbnail name
                $thumbnail = 'thumbnail_' . $filename . '_' . time() . '.' . $extension;
                $mediumthumbnail = 'medium_' . $filename . '_' . time() . '.' . $extension;

                //large thumbnail name
                $largethumbnail = 'large_' . $filename . '_' . time() . '.' . $extension;

                //Upload File
                $value->storeAs('public/listing_images', $filenametostore);
                $value->storeAs('public/listing_images/thumbnail', $thumbnail);
                $value->storeAs('public/listing_images/thumbnail', $largethumbnail);
                $value->storeAs('public/listing_images/thumbnail', $mediumthumbnail);

                //create small thumbnail
                $thumbnailpath = public_path('storage/listing_images/thumbnail/' . $thumbnail);

                $this->createThumbnail($thumbnailpath, 268, 205);

                //create large thumbnail
                $largethumbnailpath = public_path('storage/listing_images/thumbnail/' . $largethumbnail);
                $originalpath       = public_path('storage/listing_images/' . $filenametostore);

                $this->createThumbnail($largethumbnailpath, 900, 500);

                $mediumpath = public_path('storage/listing_images/thumbnail/' . $mediumthumbnail);
                $this->createThumbnail($mediumpath, 520, 397,'hard');

//                $s3filePathlargeimage     = '/large_image/' . $largethumbnail;
//                $s3filePaththumbnailimage = '/thumbnail/' . $thumbnail;
//                $s3filePathorigiinalimage = '/original/' . $filenametostore;
//                $s3filePathmediumimage = '/medium_image/' . $mediumthumbnail;
//
//                $s3->put($s3filePathlargeimage, file_get_contents($largethumbnailpath), 'public');
//                $s3->put($s3filePaththumbnailimage, file_get_contents($thumbnailpath), 'public');
//                $s3->put($s3filePathorigiinalimage, file_get_contents($originalpath), 'public');
//                $s3->put($s3filePathmediumimage, file_get_contents($mediumpath), 'public');

                Listingimage::create([
                    'listing_id'     => $listingid->id,
                    'listing_images' => $filenametostore,
                ]);

//                unlink($largethumbnailpath);
//                unlink($thumbnailpath);
//                unlink($originalpath);
//                unlink($mediumpath);
            }

            if ($request->file('supporting_document')) {
                $s3                    = \Storage::disk('s3');
                $filenamewithextension = $request->file('supporting_document')->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->file('supporting_document')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . time() . '.' . $extension;
                $originalpath    = public_path('storage/supporting_documents/' . $filenametostore);
                $request->file('supporting_document')->storeAs('public/supporting_documents', $filenametostore);
//                $s3filesupportingdocuments = '/supporting_documents/' . $filenametostore;
//                $s3->put($s3filesupportingdocuments, file_get_contents($originalpath), 'public');

                if (DB::table('listings')
                    ->where('id', $listingid->id)
                    ->update(['supporting_document' => $filenametostore])) {
                   // unlink($originalpath);
                }

            }
        }

        if ($listingid->id) {
            $adminemail = env('ADMIN_EMAIL', 'karthick.oursvib+admin@gmail.com');
            //Mail::to(adminemail)->send(new newListing($insertdata));
            $listinginfo=Listing::with('user')->findOrFail($listingid->id);

            Mail::to($adminemail)->send(new newListing($listinginfo));
//            Mail::send('vendor.mail.html.default', $listinginfo, function($message) use($listinginfo) {
//                $message->to($adminemail);
//                $message->subject('New Listing Added!');
//            });
            Session::flash('message', 'New listing added successfully.');
            return response()->json(['status' => 'success', 'message' => 'New listing added successfully.']);

        } else {
            //Session::flash('message','New listing addition failed.');
            return response()->json(['status' => 'fail', 'message' => 'New listing addition failed.']);
        }

    }

    public function deletelisting(Request $request)
    {
        $listingid = $request['listingid'];
        if (DB::table('listings')
            ->where('id', $listingid)
            ->update(['status' => '3'])) {
            Session::flash('message', 'Listing deleted successfully.');
            return response()->json(['status' => 'success', 'message' => 'Listing deleted successfully.']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'Listing deleting failed.']);
        }
    }

    public function editListing(Request $request)
    {
        // echo $request['id'];
        $vendors = User::where('role', '2')->whereNotNull('email_verified_at')->get();
        // $listinginfo=Listing::findorfail($request['id']);
        $listinginfo  = Listing::with('listingnearby', 'listingprice', 'listingcapacity', 'listingactivity', 'listingamenity', 'listingadditional', 'listingimages')->findorfail($request['id']);
        $rootcategory = Category::all();
        //print_r(json_encode($listinginfo));exit;
        $listingtype    = DB::table('listing_type')->get();
        $billingtype    = DB::table('billing_type')->get();
        $countries      = DB::table('country')->get();
        $months         = array('1' => "Jan", '2' => 'Feb', '3' => 'Mar', '4' => 'Apr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Aug', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
        $amenities      = Amenity::with('subamenity')->where('parent_id', '=', '0')->get();
        $activities     = Activity::with('subactivity')->where('parent_id', '=', '0')->get();
        $additionalfees = DB::table('additonal_fee')->get();
        //  print_r($activity);
        //print_r(json_encode($activity));exit;
        return view('admin.pages.editlisting', compact('vendors', 'rootcategory', 'listingtype', 'billingtype', 'countries', 'months', 'amenities', 'activities', 'additionalfees', 'listinginfo'));
    }

    public function updateListing(Request $request)
    {
        //   echo '<pre>';
        // print_r($request->all()); exit;
        // print_r($request->file('images'));
        // print_r($request['amenities']);

        $listing = Listing::find($request->listing_id);
        if ($listing) {
            Listing::where('id', $listing->id)->update([
                'vendor_id'         => $request->vendor_id,
                'root_category'     => $request->root_category,
                'parent_category'   => $request->parent_category,
                'child_category'    => $request->child_category,
                'niche_category'    => $request->niche_category,
                'listing_type'      => $request->listing_type,
                'title'             => $request->title,
                'description'       => $request->description,
                'about'             => $request->aboutus,
                'team'              => $request->team,
                'unique_services'   => $request->unique_services,
                'stragetic_partner' => $request->stragetic_patner,
                'guest_experience'  => $request->guest_experience,
                'news_highlight'    => $request->news_highlight,
                'green_innitiative' => $request->green_innitiative,
                'star_rating'       => $request->star_rating,
                'csr_partner'       => $request->csr_partner,
                'food_partner'      => $request->food_partner,
                'capacity_by'       => $request->capacity_by,
                'address'           => $request->address,
                'city'              => $request->city,
                'state'             => $request->state,
                'country'           => $request->country,
                'zipcode'           => $request->zipcode,
                'video'             => $request->videolink,
                'dvrlink'             => $request->dvrlink
            ]);

            //near by
            Listingnearby::where('listing_id', $listing->id)->delete();
            foreach ($request['nearby'] as $nearby) {
                Listingnearby::create([
                    'listing_id' => $listing->id,
                    'nearby'     => $nearby['location'],
                    'distance'   => $nearby['distance'],
                ]);

            }

            //listing additional
            foreach ($request['additional_fee'] as $additionalfee) {
                Listingadditional::where('id', $additionalfee['listing_additional_id'])->update([
                    'listing_id'    => $listing->id,
                    'additional_id' => $additionalfee['additional_id'],
                    'type'          => $additionalfee['type'],
                    'amount'        => $additionalfee['amount'],
                ]);
            }

            //capacity
            Listingcapacity::where('listing_id', $listing->id)->update([
                'area_by'                 => $request['area_by'],
                'min_pax'                 => $request['min_pax'],
                'max_pax'                 => $request['max_pax'],
                'seating_pax'             => $request['seating_pax'],
                'standing_pax'            => $request['standing_pax'],
                'cooktail_pax'            => $request['cooktail_pax'],
                'classroom_pax'           => $request['classroom_pax'],
                'theatre_pax'             => $request['theatre_pax'],
                'banquet_pax'             => $request['banquet_pax'],
                'conference_pax'          => $request['conference_pax'],
                'ushape_pax'              => $request['ushape_pax'],
                'height'                  => $request['height'],
                'length'                  => $request['length'],
                'width'                   => $request['width'],
                'screen_size'             => $request['screen_size'],
                'panel_size'              => $request['panel_size'],
                'letter_height'           => $request['letter_height'],
                'best_impact'             => $request['best_impact'],
                'max_readable_distance'   => $request['max_readable_distance'],
                'floor_signage_dimension' => $request['floor_signage_dimension'],
            ]);

            //listing amenity delete and insert
            Listingamenity::where('listing_id', $listing->id)->delete();
            for ($i = 0; $i < count($request['amenities']); $i++) {
                Listingamenity::create([
                    'listing_id' => $listing->id,
                    'amenity_id' => $request['amenities'][$i],
                ]);
            }

            //listing activity delete and insert
            Listingactivity::where('listing_id', $listing->id)->delete();
            for ($i = 0; $i < count($request['activity']); $i++) {
                Listingactivity::create([
                    'listing_id'  => $listing->id,
                    'activity_id' => $request['activity'][$i],
                ]);
            }

            //listing price
            Listingprice::where('listing_id', $listing->id)->delete();
            foreach ($request['price'] as $price) {
                Listingprice::create([
                    'listing_id'   => $listing->id,
                    'billing_type' => $price['billing_type'],
                    'peak_start'   => $price['peakstart'],
                    'peak_end'     => $price['peakend'],
                    'normal_price' => $price['normalprice'],
                    'peak_price'   => $price['peakprice'],
                ]);
            }
            //listing image
            //for images
            if ($request->file('images')) {
                Listingimage::where('listing_id', $listing->id)->delete();
                foreach ($request->file('images') as $key => $value) {
                    $s3                    = \Storage::disk('s3');
                    $filenamewithextension = $value->getClientOriginalName();

                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //get file extension
                    $extension = $value->getClientOriginalExtension();

                    //filename to store
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //thumbnail name
                    $thumbnail = 'thumbnail_' . $filename . '_' . time() . '.' . $extension;
                    $mediumthumbnail = 'medium_' . $filename . '_' . time() . '.' . $extension;
                    //large thumbnail name
                    $largethumbnail = 'large_' . $filename . '_' . time() . '.' . $extension;

                    //Upload File
                    $value->storeAs('public/listing_images', $filenametostore);
                    $value->storeAs('public/listing_images/thumbnail', $thumbnail);
                    $value->storeAs('public/listing_images/thumbnail', $largethumbnail);
                    $value->storeAs('public/listing_images/thumbnail', $mediumthumbnail);
                    //create small thumbnail
                    $thumbnailpath = public_path('storage/listing_images/thumbnail/' . $thumbnail);
                    $this->createThumbnail($thumbnailpath, 268, 205);

                    //create large thumbnail
                    $largethumbnailpath = public_path('storage/listing_images/thumbnail/' . $largethumbnail);
                    $originalpath       = public_path('storage/listing_images/' . $filenametostore);

                    $this->createThumbnail($largethumbnailpath, 900, 500);

                    $mediumpath = public_path('storage/listing_images/thumbnail/' . $mediumthumbnail);
                    $this->createThumbnail($mediumpath, 520, 397,'hard');

                    $s3filePathlargeimage     = '/large_image/' . $largethumbnail;
                    $s3filePaththumbnailimage = '/thumbnail/' . $thumbnail;
                    $s3filePathorigiinalimage = '/original/' . $filenametostore;
                    $s3filePathmediumimage = '/medium_image/' . $mediumthumbnail;

                    $s3->put($s3filePathlargeimage, file_get_contents($largethumbnailpath), 'public');
                    $s3->put($s3filePaththumbnailimage, file_get_contents($thumbnailpath), 'public');
                    $s3->put($s3filePathorigiinalimage, file_get_contents($originalpath), 'public');
                    $s3->put($s3filePathmediumimage, file_get_contents($mediumpath), 'public');

                    Listingimage::create([
                        'listing_id'     => $listing->id,
                        'listing_images' => $filenametostore,
                    ]);

                    unlink($largethumbnailpath);
                    unlink($thumbnailpath);
                    unlink($originalpath);
                    unlink($mediumpath);
                }
            }
            //listing document
            if ($request->file('supporting_document')) {
                $s3                    = \Storage::disk('s3');
                $filenamewithextension = $request->file('supporting_document')->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->file('supporting_document')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . time() . '.' . $extension;
                $originalpath    = public_path('storage/supporting_documents/' . $filenametostore);
                $request->file('supporting_document')->storeAs('public/supporting_documents', $filenametostore);
                $s3filesupportingdocuments = '/supporting_documents/' . $filenametostore;
                $s3->put($s3filesupportingdocuments, file_get_contents($originalpath), 'public');

                if (DB::table('listings')
                    ->where('id', $listing->id)
                    ->update(['supporting_document' => $filenametostore])) {
                    unlink($originalpath);
                }

            }
            if ($listing->id) {
                Session::flash('message', 'Listing updated successfully.');
                return response()->json(['status' => 'success', 'message' => 'Listing added successfully.']);

            }
        } else {
            return response()->json(['status' => 'fail', 'message' => 'Listing updation failed.']);
        }

    }

    public function approveListing(Request $request){
        $listingid=$request['listingid'];
        if(Listing::with('user')->findOrFail($listingid)){
            Listing::where('id',$listingid)->update(['status'=>'1']);
            $listinginfo=Listing::with('user')->findOrFail($listingid);
            Mail::to($listinginfo->user->email)->send(new listingApproved($listinginfo));
            Session::flash('message', 'Listing approved.');
            return response()->json(['status' => 'success', 'message' => 'Listing approved.']);
        }else{
            Session::flash('message', 'Listing not found.');
            return response()->json(['status' => 'error', 'message' => 'Listing not found.']);
        }

    }

    public function unapproveListing(Request $request){
        $listingid=$request['listingid'];
        if(Listing::with('user')->findOrFail($listingid)){
            Listing::where('id',$listingid)->update(['status'=>'2']);
            $listinginfo=Listing::with('user')->findOrFail($listingid);
            Mail::to($listinginfo->user->email)->send(new listingUnapproved($listinginfo));
            Session::flash('message', 'Listing suspended.');
            return response()->json(['status' => 'success', 'message' => 'Listing suspended.']);
        }else{
            Session::flash('message', 'Listing not found.');
            return response()->json(['status' => 'error', 'message' => 'Listing not found.']);
        }

    }
}
