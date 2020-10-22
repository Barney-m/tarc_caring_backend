<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackAPIController extends Controller
{
    public function index()
    {
        return Feedback::where('status', 'pending')->get();
    }

    public function getPending(){

    }
}
