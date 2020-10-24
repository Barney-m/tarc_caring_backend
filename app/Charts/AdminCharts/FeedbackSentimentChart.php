<?php

declare(strict_types = 1);

namespace App\Charts\AdminCharts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Feedback;

class FeedbackSentimentChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $P1facilities = [];
        $P2facilities = [];
        $P3facilities = [];
        $P4facilities = [];
        $P1foods = [];
        $P2foods = [];
        $P3foods = [];
        $P4foods = [];
        $P1educations = [];
        $P2educations = [];
        $P3educations = [];
        $P4educations = [];
        $P1services = [];
        $P2services = [];
        $P3services = [];
        $P4services = [];
        $feedbacks = Feedback::whereYear('created_at', '=', 2020)->get();
        foreach($feedbacks as $feedback){
            if($feedback->priority == 1){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P1facilities, $feedback);
                        break;
                    case 2:
                        array_push($P2facilities, $feedback);
                        break;
                    case 3:
                        array_push($P3facilities, $feedback);
                        break;
                    case 4:
                        array_push($P4facilities, $feedback);
                        break;
                    default:
                        break;
                }
            }
            else if($feedback->priority == 2){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P1foods, $feedback);
                        break;
                    case 2:
                        array_push($P2foods, $feedback);
                        break;
                    case 3:
                        array_push($P3foods, $feedback);
                        break;
                    case 4:
                        array_push($P4foods, $feedback);
                        break;
                    default:
                        break;
                }
            }
            else if($feedback->priority == 3){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P1educations, $feedback);
                        break;
                    case 2:
                        array_push($P2educations, $feedback);
                        break;
                    case 3:
                        array_push($P3educations, $feedback);
                        break;
                    case 4:
                        array_push($P4educations, $feedback);
                        break;
                    default:
                        break;
                }
            }
            else if($feedback->priority == 4){
                switch($feedback->feedbackType_id){
                    case 1:
                        array_push($P1services, $feedback);
                        break;
                    case 2:
                        array_push($P2services, $feedback);
                        break;
                    case 3:
                        array_push($P3services, $feedback);
                        break;
                    case 4:
                        array_push($P4services, $feedback);
                        break;
                    default:
                        break;
                }
            }
        }

        $priority1 = array(
            count($P1facilities),
            count($P1foods),
            count($P1educations),
            count($P1services),
        );

        $priority2 = array(
            count($P2facilities),
            count($P2foods),
            count($P2educations),
            count($P2services),
        );

        $priority3 = array(
            count($P3facilities),
            count($P3foods),
            count($P3educations),
            count($P3services),
        );

        $priority4 = array(
            count($P4facilities),
            count($P4foods),
            count($P4educations),
            count($P4services),
        );

        return Chartisan::build()
            ->labels(['Facilities', 'Foods', 'Educations', 'Services'])
            ->dataset('Priority 1', $priority1)
            ->dataset('Priority 2', $priority2)
            ->dataset('Priority 3', $priority3)
            ->dataset('Priority 4', $priority4);
    }
}
