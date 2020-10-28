<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
Use Sentiment\Analyzer;

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

    public function submit(Request $request){
        $priority;
        if($request->comment != null){
            $analyzer = new Analyzer();
            $dictionary = ['rubbish' => -1.5, 'cb' => -1.5, 'lapsap' => -1.5, 'shit' => -1.5];
            $analyzer->updateLexicon($dictionary);
            $score = $analyzer->getSentiment($request->comment);
            $result = $score['compound'] * 100;
            if($result > 60){
                $priority = 5;
            }
            else if($result > 20){
                $priority = 4;
            }
            else if($result <= 20 && $result >= -20){
                $priority = 3;
            }
            else if($result < -20 && $result >= -60){
                $priority = 2;
                return $result;
            }
            else{
                $priority = 1;
            }
        }

        if($request->feedback_type == 1){

        }
        else if($request->feedback_type == 2){

        }
        else if($request->feedback_type == 3){

            return Feedback::create([
                'feedbackType_id' => $request->feedback_type,
                'choice' => $request->lecturer_id,
                'comment' => $request->comment,
                'creator_id' => $request->user_id,
                'anonymous' => ($request->anonymous == true) ? 1 : 0,
                'priority' => $priority,
                'status' => 'pending',
            ]);
        }
        else if($request->feedback_type == 4){

        }
        else{

        }
    }
}
