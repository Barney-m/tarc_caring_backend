<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Facades\Datatables;

class ManageManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){
        $datas = User::where('role_id', 5)->get();

        return view('admin.manage_management', ['datas' => $datas]);
    }
}
