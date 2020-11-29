<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $datas = User::where('role_id', 5)->get();

        return view('admin.manage_management', ['datas' => $datas]);
    }

    public function details(Request $request){
        $details = User::where('user_id', $request->id)->get();

        return view('admin.management_details', ['details' => $details]);
    }

    public function edit(Request $request){

        $editName = false;
        $editMobileNo = false;
        $editEmail = false;
        $editStatus = false;
        $message = "";
        $user = User::where('user_id', $request->id)->first();

        if($request->name != null){
            $editName = true;
            $user->name = $request->name;
        }

        if($request->mobile_no != null){
            $editMobileNo = true;
            $user->mobile_no = $request->mobile_no;
        }

        if($request->email != null){
            $editEmail = true;
            $user->email = $request->email;
        }

        if($request->status != "0"){
            $editStatus = true;
            $user->status = $request->status;
        }


        if($editName === true || $editMobileNo === true || $editEmail === true || $editStatus === true){
            $email = User::where('email', $request->email)->first();
            if($email == null){
                $user->save();
                $message = "Update Successfully";
            }
            else{
                $message = "Email duplicated.";
                return back()->with(['details' => $user, 'message' => $message]);
            }
        } else{
            $message = "At least 1 change required.";
            return back()->with(['details' => $user, 'message' => $message]);
        }


        $datas = User::where('role_id', 5)->get();

        return view('admin.manage_management', ['datas' => $datas, 'message' => $message]);
    }
}
