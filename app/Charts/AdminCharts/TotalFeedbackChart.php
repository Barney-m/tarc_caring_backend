<?php

declare(strict_types = 1);

namespace App\Charts\AdminCharts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Feedback;

class TotalFeedbackChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $feedbacks = Feedback::join('users', 'users.user_id', '=', 'feedbacks.creator_id')->get();
        $facilitiesStudent = [];
        $facilitiesLecturer = [];
        $facilitiesStaff = [];
        $foodsStudent = [];
        $foodsLecturer = [];
        $foodsStaff = [];
        $educationsStudent = [];
        $educationsLecturer = [];
        $educationsStaff = [];
        $servicesStudent = [];
        $servicesLecturer = [];
        $servicesStaff = [];

        foreach($feedbacks as $feedback){
            if($feedback->feedbackType_id == 1){
                switch($feedback->role_id){
                    case 2:
                        array_push($facilitiesStudent, $feedback);
                        break;
                    case 3:
                        array_push($facilitiesLecturer, $feedback);
                        break;
                    case 4:
                        array_push($facilitiesStaff, $feedback);
                        break;
                }
            }
            else if($feedback->feedbackType_id == 2){
                switch($feedback->role_id){
                    case 2:
                        array_push($foodsStudent, $feedback);
                        break;
                    case 3:
                        array_push($foodsLecturer, $feedback);
                        break;
                    case 4:
                        array_push($foodsStaff, $feedback);
                        break;
                }
            }
            else if($feedback->feedbackType_id == 3){
                switch($feedback->role_id){
                    case 2:
                        array_push($educationsStudent, $feedback);
                        break;
                    case 3:
                        array_push($educationsLecturer, $feedback);
                        break;
                    case 4:
                        array_push($educationsStaff, $feedback);
                        break;
                }
            }
            else if($feedback->feedbackType_id == 4){
                switch($feedback->role_id){
                    case 2:
                        array_push($servicesStudent, $feedback);
                        break;
                    case 3:
                        array_push($servicesLecturer, $feedback);
                        break;
                    case 4:
                        array_push($servicesStaff, $feedback);
                        break;
                }
            }
        }

        $students = array(
            count($facilitiesStudent),
            count($foodsStudent),
            count($educationsStudent),
            count($servicesStudent),



        );

        $lecturers = array(
            count($facilitiesLecturer),
            count($foodsLecturer),
            count($educationsLecturer),
            count($servicesLecturer),
        );

        $staffs = array(
            count($facilitiesStaff),
            count($foodsStaff),
            count($educationsStaff),
            count($servicesStaff),
        );

        return Chartisan::build()
            ->labels(['Campus Facilities', 'Canteen Foods', 'Education Quality', 'Service Attitude'])
            ->dataset('Students', $students)
            ->dataset('Lecturers', $lecturers)
            ->dataset('Staff', $staffs);
    }
}
