<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subchildcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = DB::table('categories as p')->leftJoin('subcategories as c1', 'c1.parent_id', '=', 'p.id')->leftJoin('subchildcategories as c2', 'c2.parent_id', '=', 'c1.id')->leftJoin('sublowerchildcategories as c3', 'c3.parent_id', '=', 'c2.id')->select('p.name as rootname', 'c1.name as subcatname', 'c2.name as subchildname', 'c3.name as sublowercategory')->orderBy('p.id', 'asc')->get();

        // $ response()->json($categories);->
        return view('admin.pages.managecategories')->with(compact('categories'));
    }

    public function addParentCategory()
    {
        $rootcategory = Category::all();
        return view('admin.pages.addcategorymodal')->with(compact('rootcategory'));
    }

    public function addChildCategory()
    {
        $rootcategory = Category::with('subcategory')->get();
     //   echo '<pre>';print_r($rootcategory);exit;
        return view('admin.pages.addchildcategorymodal')->with(compact('rootcategory'));
    }

    public function addNicheCategory()
    {
        $rootcategory = Category::with('subcategory')->get();
     //   echo '<pre>';print_r($rootcategory);exit;
        return view('admin.pages.addnichecategorymodal')->with(compact('rootcategory'));
    }
    public function saveParentCategory(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'parent_id' => 'required',
            'name'      => 'required',
        ]);
        $check = Subcategory::create($input);
        $arr   = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        }
        return response()->json($arr);
    }

    public function saveChildCategory(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'parent_id' => 'required',
            'name'      => 'required',
        ]);
        $check = Subchildcategory::create($input);
        $arr   = array('msg' => 'Something goes to wrong. Please try again later', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Successfully Form Submit', 'status' => true);
        }
        return response()->json($arr);
    }
}
