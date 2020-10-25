<?php

declare(strict_types = 1);

namespace App\Charts\AdminCharts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Feedback;

class PriorityChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $feedbacks = Feedback::all();
        $P1Facilities = [];
        $P1Foods = [];
        $P1Educations = [];
        $P1Services = [];
        $P2Facilities = [];
        $P2Foods = [];
        $P2Educations = [];
        $P2Services = [];
        $P3Facilities = [];
        $P3Foods = [];
        $P3Educations = [];
        $P3Services = [];
        $P4Facilities = [];
        $P4Foods = [];
        $P4Educations = [];
        $P4Services = [];
        $P5Facilities = [];
        $P5Foods = [];
        $P5Educations = [];
        $P5Services = [];
        foreach($feedbacks as $feedback){
            if($feedback->priority == 1){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P1Facilities, $feedback);
                        break;
                    case 2:
                        array_push($P1Foods, $feedback);
                        break;
                    case 3:
                        array_push($P1Educations, $feedback);
                        break;
                    case 4:
                        array_push($P1Services, $feedback);
                        break;
                }
            }
            else if($feedback->priority == 2){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P2Facilities, $feedback);
                        break;
                    case 2:
                        array_push($P2Foods, $feedback);
                        break;
                    case 3:
                        array_push($P2Educations, $feedback);
                        break;
                    case 4:
                        array_push($P2Services, $feedback);
                        break;
                }
            }
            else if($feedback->priority == 3){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P3Facilities, $feedback);
                        break;
                    case 2:
                        array_push($P3Foods, $feedback);
                        break;
                    case 3:
                        array_push($P3Educations, $feedback);
                        break;
                    case 4:
                        array_push($P3Services, $feedback);
                        break;
                }
            }
            else if($feedback->priority == 4){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P4Facilities, $feedback);
                        break;
                    case 2:
                        array_push($P4Foods, $feedback);
                        break;
                    case 3:
                        array_push($P4Educations, $feedback);
                        break;
                    case 4:
                        array_push($P4Services, $feedback);
                        break;
                }
            }
            else if($feedback->priority == 5){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P5Facilities, $feedback);
                        break;
                    case 2:
                        array_push($P5Foods, $feedback);
                        break;
                    case 3:
                        array_push($P5Educations, $feedback);
                        break;
                    case 4:
                        array_push($P5Services, $feedback);
                        break;
                }
            }
        }

        $priority1 = array(
            count($P1Facilities),
            count($P1Foods),
            count($P1Educations),
            count($P1Services),
        );

        $priority2 = array(
            count($P2Facilities),
            count($P2Foods),
            count($P2Educations),
            count($P2Services),
        );

        $priority3 = array(
            count($P3Facilities),
            count($P3Foods),
            count($P3Educations),
            count($P3Services),
        );

        $priority4 = array(
            count($P4Facilities),
            count($P4Foods),
            count($P4Educations),
            count($P4Services),
        );

        $priority5 = array(
            count($P5Facilities),
            count($P5Foods),
            count($P5Educations),
            count($P5Services),
        );

        return Chartisan::build()
            ->labels(['Campus Facilities', 'Canteen Foods', 'Education Quality', 'Service Attitude'])
            ->dataset('Priority 1', $priority1)
            ->dataset('Priority 2', $priority2)
            ->dataset('Priority 3', $priority3)
            ->dataset('Priority 4', $priority4)
            ->dataset('Priority 5', $priority5);
    }
}
