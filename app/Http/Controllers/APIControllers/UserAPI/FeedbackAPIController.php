<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class FeedbackAPIController extends Controller
{
    public function index(Request $request)
    {
        if($request->priority == null){
            return Feedback::where('status', 'pending')
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->select('feedbacks.*', 'feedback_types.type')
                    ->get();
        }

        return Feedback::where('status', 'pending')
                ->where('priority', $request->priority)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function facilities(){
        return Feedback::where('status', 'pending')
                ->where('feedbackType_id','1')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function foods(){
        return Feedback::where('status', 'pending')
                ->where('feedbackType_id','2')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function educations(){
        return Feedback::where('status', 'pending')
                ->where('feedbackType_id','3')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function services(){
        return Feedback::where('status', 'pending')
                ->where('feedbackType_id','4')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function approved(){
        return Feedback::where('status', 'approved')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function urgent(){
        return Feedback::where('status', 'urgent')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function history(){
        return Feedback::where('status', 'solved')
                ->orWhere('status', 'dismissed')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function facilitiesHistory(){
        return Feedback::where('feedbackType_id', '1')
                ->where(function($query){
                    $query->where('status', 'solved')
                        ->orWhere('status', 'dismissed');
                })
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function foodsHistory(){
        return Feedback::where('feedbackType_id', '2')
                ->where(function($query){
                    $query->where('status', 'solved')
                        ->orWhere('status', 'dismissed');
                })
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function educationsHistory(){
        return Feedback::where('feedbackType_id', '3')
                ->where(function($query){
                    $query->where('status', 'solved')
                        ->orWhere('status', 'dismissed');
                })
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function servicesHistory(){
        return Feedback::where('feedbackType_id', '4')
                ->where(function($query){
                    $query->where('status', 'solved')
                        ->orWhere('status', 'dismissed');
                })
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function userHistory(Request $request){
        if($request->id != null){
            if($request->feedback != null){
                return Feedback::where('status', 'pending')
                    ->where('feedbackType_id', intval($request->feedback))
                    ->where('creator_id', $request->id)
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->select('feedbacks.*', 'feedback_types.type')
                    ->get();
            }
            else{
                return Feedback::where('status', 'pending')
                    ->where('creator_id', $request->id)
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->select('feedbacks.*', 'feedback_types.type')
                    ->get();
            }
        }
        else{
            return json_encode(array(
                "message" => 'Unauthenticated.'
            ));
        }
    }

    public function feedback_action(Request $request){
        if($request->action == 'dismiss'){
            Feedback::find($request->id)
                ->update([
                    'status' => 'dismissed',
                    'dismiss_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else if($request->action == 'approve'){
            Feedback::find($request->id)
                ->update([
                    'status' => 'approved',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else if($request->action == 'urgent'){
            Feedback::find($request->id)
                ->update([
                    'status' => 'urgent',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else{
            return response()->json([
                'message' => 'Invalid Action.',
                'success' => false
            ]);
        }

        return response()->json([
            'message' => 'Feedback Updated.',
            'success' => false
        ]);
    }

    public function lecturer(Request $request){
        if($request->faculty == 'All'){
            return User::where('role_id', '3')
                    ->where('status', 'Active')
                    ->get();
        }
        else{
            return User::where('role_id', 3)
                    ->where('status', 'Active')
                    ->where('faculty_id', $request->faculty)
                    ->get();
        }
    }
}
