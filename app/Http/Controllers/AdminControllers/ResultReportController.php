<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class ResultReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $solve = [];
        $dismiss = [];
        if($request->year != null){
            $feedbacks = Feedback::whereYear('created_at', '=', $request->year)
                        ->get();
        } else{
            $feedbacks = Feedback::whereYear('created_at', '=', date("Y"))
                        ->get();
        }

        foreach($feedbacks as $feedback){
            if($feedback->status == 'solved'){
                array_push($solve, $feedback);
            }
            else if($feedback->status == 'dismissed'){
                array_push($dismiss, $feedback);
            }
        }

        $labels = ['Solved', 'Dismissed'];
        $solved = array(count($solve));
        $dismissed = array(count($dismiss));
        $year = $request->year;
        return view('admin.result_report', compact('labels', 'solved', 'dismissed', 'year'));
    }
}
