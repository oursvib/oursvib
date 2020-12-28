<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class UserController extends Controller
{
    public function index()
    {
        $users = User::wherein('role',array('2','3','4'))->get();
        return view('admin.pages.manageuser', compact('users'));
    }

    public function deleteUser(Request $request){
        $userid = $request['userid'];
        if (DB::table('users')
            ->where('id', $userid)
            ->update(['status_id' => '3'])) {
            Session::flash('message', 'User deleted successfully.');
            return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'User deleting failed.']);
        }
    }

    public function suspendUser(Request $request){
        $userid = $request['userid'];
        if (DB::table('users')
            ->where('id', $userid)
            ->update(['status_id' => '2'])) {
            Session::flash('message', 'User suspended successfully.');
            return response()->json(['status' => 'success', 'message' => 'User suspended successfully.']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'User suspending failed.']);
        }
    }


    public function activateUser(Request $request){
        $userid = $request['userid'];
        if (DB::table('users')
            ->where('id', $userid)
            ->update(['status_id' => '1'])) {
            Session::flash('message', 'User activated successfully.');
            return response()->json(['status' => 'success', 'message' => 'User activated successfully.']);
        } else {
            return response()->json(['status' => 'fail', 'message' => 'User activation failed.']);
        }
    }


    public function editUser(Request $request){
        $userid=$request['id'];
        $user = User::findorfail($userid);
        return view('admin.pages.edituser')->with(compact('user'));
    }
}
