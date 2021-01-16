<?php
    
    namespace App\Http\Controllers;
    
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
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
            
            return view('customer.pages.home')->with(compact('countries'));
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
        
    }
