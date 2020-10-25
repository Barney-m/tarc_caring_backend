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

        return Chartisan::build()
            ->labels(['User'])
            ->dataset('Student', [1])
            ->dataset('Lecturer', [1])
            ->dataset('Staff', [1]);
    }
}
