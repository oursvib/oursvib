<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{

    public function getParentCategory(Request $request){
        $childcategory=DB::table('subcategories')->where('parent_id','=',$request->id)->get();
        return response()->json($childcategory);
    }

    public function getChildCategory(Request $request){
        $childcategory=DB::table('subchildcategories')->where('parent_id','=',$request->id)->get();
        return response()->json($childcategory);
    }

    public function getNicheCategory(Request $request){
        $childcategory=DB::table('sublowerchildcategories')->where('parent_id','=',$request->id)->get();
        return response()->json($childcategory);
    }

    public function getStates(Request $request){
        $states=DB::table('region')->where('countryId','=',$request->id)->get();
        return response()->json($states);
    }
    public function getCities(Request $request){
        $states=DB::table('cities')->where('regionId','=',$request->id)->get();
        return response()->json($states);
    }
}
