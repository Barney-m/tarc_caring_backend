<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class SentimentReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $PositiveFacilities = [];
        $NeutralFacilities = [];
        $NegativeFacilities = [];
        $PositiveFoods = [];
        $NeutralFoods = [];
        $NegativeFoods = [];
        $PositiveEducations = [];
        $NeutralEducations = [];
        $NegativeEducations = [];
        $PositiveServices = [];
        $NeutralServices = [];
        $NegativeServices = [];

        if($request->year != null){

            $feedbacks = Feedback::whereYear('created_at', '=', $request->year)->get();

        } else{
            $feedbacks = Feedback::whereYear('created_at', '=', date("Y"))->get();
        }

        foreach($feedbacks as $feedback){
            if($feedback->priority < 3){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($NegativeFacilities, $feedback);
                        break;
                    case 2:
                        array_push($NegativeFoods, $feedback);
                        break;
                    case 3:
                        array_push($NegativeEducations, $feedback);
                        break;
                    case 4:
                        array_push($NegativeServices, $feedback);
                        break;
                    default:
                        break;
                }
            }
            else if($feedback->priority == 3){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($NeutralFacilities, $feedback);
                        break;
                    case 2:
                        array_push($NeutralFoods, $feedback);
                        break;
                    case 3:
                        array_push($NeutralEducations, $feedback);
                        break;
                    case 4:
                        array_push($NeutralServices, $feedback);
                        break;
                    default:
                        break;
                }
            }
            else if($feedback->priority > 3){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($PositiveFacilities, $feedback);
                        break;
                    case 2:
                        array_push($PositiveFoods, $feedback);
                        break;
                    case 3:
                        array_push($PositiveEducations, $feedback);
                        break;
                    case 4:
                        array_push($PositiveServices, $feedback);
                        break;
                    default:
                        break;
                }
            }
        }

        $negative = array(
            count($NegativeFacilities),
            count($NegativeFoods),
            count($NegativeEducations),
            count($NegativeServices),
        );

        $neutral = array(
            count($NeutralFacilities),
            count($NeutralFoods),
            count($NeutralEducations),
            count($NeutralServices),
        );

        $positive = array(
            count($PositiveFacilities),
            count($PositiveFoods),
            count($PositiveEducations),
            count($PositiveServices),
        );

        $labels = ['Facilities', 'Foods', 'Educations', 'Services'];
        $positives = $positive;
        $neutrals = $neutral;
        $negatives = $negative;
        $year = $request->year;

        return view('admin.sentiment_report', compact('labels','positives','neutrals','negatives', 'year'));
    }
}
