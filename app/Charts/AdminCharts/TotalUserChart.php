<?php

declare(strict_types = 1);

namespace App\Charts\AdminCharts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User;

class TotalUserChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $users = User::where('role_id','!=',5)->get();

        $students = [];
        $lecturers = [];
        $staffs = [];

        foreach($users as $user){
            switch($user->role_id){
                case 2:
                    array_push($students, $user);
                    break;
                case 3:
                    array_push($lecturers, $user);
                    break;
                case 4:
                    array_push($staffs, $user);
                    break;
                default:
                    break;
            }
        }

        $count1 = count($students);
        $count2 = count($lecturers);
        $count3 = count($staffs);

        return Chartisan::build()
            ->labels(['User'])
            ->dataset('Student', [$count1])
            ->dataset('Lecturer', [$count2])
            ->dataset('Staff', [$count3]);
    }
}
