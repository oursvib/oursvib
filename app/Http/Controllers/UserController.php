<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function adduser(Request $request){

        return view('admin.pages.adduser');
    }

    public function validateEmailEdit(Request $request){

        $user=User::where('email','=',$request['email'])->where('id','<>',$request['id'])->get();
        if($user->count()){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function validateEmailAdd(Request $request){

        $user=User::where('email','=',$request['email'])->get();
        if($user->count()){
            return 'false';
        }else{
            return 'true';
        }
    }

    public function updateUser(Request $request)
    {
        $userid = $request['userid'];
        $user = User::findorfail($userid);
        if ($user->role == '2' || $user->role == '3') {
            User::where('id', $userid)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'company_name' => $request['company_name'],
                'phone_number' => $request['phone_number'],
            ]);
          //  Session::flash('message', 'User details updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'User details updated successfully.']);
        }else{
            User::where('id', $userid)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'phone_number' => $request['phone_number'],
            ]);
            //Session::flash('message', 'User details updated successfully.');
            return response()->json(['status' => 'success', 'message' => 'User details updated successfully.']);
        }
    }


    public function saveUser(Request $request){


        $user=User::create([
            'role' => $request['role'],
            'name' => $request['name'],
            'email' => $request['email'],
            'password'=> Hash::make($request['password']),
            'company_name' => $request['company_name'],
            'phone_number' => $request['phone_number'],
            'status_id'=>'1'
        ]);
        if($user->sendEmailVerificationNotification()){
            return response()->json(['status' => 'success', 'message' => 'User created successfully.']);
        }else{
            return response()->json(['status' => 'success', 'message' => 'User creation failed.']);
        }
    }
}
