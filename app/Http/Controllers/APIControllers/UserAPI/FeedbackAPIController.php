<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
Use Sentiment\Analyzer;
use Symfony\Component\HttpFoundation\File\File;

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
                return Feedback::where('feedbackType_id', intval($request->feedback))
                    ->where('creator_id', $request->id)
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->select('feedbacks.*', 'feedback_types.type')
                    ->get();
            }
            else{
                return Feedback::where('creator_id', $request->id)
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
            Feedback::where('id',$request->id)
                ->update([
                    'status' => 'dismissed',
                    'dismiss_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else if($request->action == 'approve'){
            Feedback::where('id',$request->id)
                ->update([
                    'status' => 'approved',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else if($request->action == 'urgent'){
            Feedback::where('id',$request->id)
                ->update([
                    'status' => 'urgent',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);
        }
        else if($request->action == 'recall'){
            Feedback::where('id',$request->id)
                ->update(['status' => 'recalled']);
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

    public function feedback_details(Request $request){
        if($request->id != null){
            return Feedback::where('id', $request->id)
                    ->join('users', 'feedbacks.creator_id', '=', 'user_id')
                    ->get();
        }
        else {
            return response()->json([
                'error' => 'Feedback Not Found',
            ]);
        }
    }

    public function submit(Request $request){
        if($request->attachment != null){
            $image_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->attachment));
            //grab a new tmp file
            $tmpFilePath=sys_get_temp_dir().'/'.uniqid();
            //write the image to it
            file_put_contents($tmpFilePath, $image_data);
            //move it.
            //give it a name
            $f = finfo_open();
            $mime_type = finfo_buffer($f, $image_data, FILEINFO_MIME_TYPE);
            $imageName = Str::random(20).'.'.str_replace("image/","",$mime_type);
            //if using Symfony\Component\HttpFoundation\File\File;
            //get an instance of File from the temp file and call ->move on it
            $tmpFile=new File($tmpFilePath);
            $tmpFile->move(public_path('images/image_attachment/'), $imageName);
        }


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
            if($request->attachment != null){
                Feedback::create([
                    'feedbackType_id' => $request->feedback_type,
                    'choice' => $request->action,
                    'comment' => $request->comment,
                    'attachment' => $imageName,
                    'creator_id' => $request->user_id,
                    'anonymous' => ($request->anonymous == true) ? 1 : 0,
                    'priority' => $priority,
                    'status' => 'pending',
                ]);

                return response()->json(['success' => true]);
            }
            else{
                Feedback::create([
                    'feedbackType_id' => $request->feedback_type,
                    'choice' => $request->action,
                    'comment' => $request->comment,
                    'creator_id' => $request->user_id,
                    'anonymous' => ($request->anonymous == true) ? 1 : 0,
                    'priority' => $priority,
                    'status' => 'pending',
                ]);

                return response()->json(['success' => true]);
            }
        }
        else if($request->feedback_type == 2){
            if($request->attachment != null){
                Feedback::create([
                    'feedbackType_id' => $request->feedback_type,
                    'choice' => $request->action,
                    'comment' => $request->comment,
                    'attachment' => $imageName,
                    'creator_id' => $request->user_id,
                    'anonymous' => ($request->anonymous == true) ? 1 : 0,
                    'priority' => $priority,
                    'status' => 'pending',
                ]);

                return response()->json(['success' => true]);
            }
            else{
                Feedback::create([
                    'feedbackType_id' => $request->feedback_type,
                    'choice' => $request->action,
                    'comment' => $request->comment,
                    'creator_id' => $request->user_id,
                    'anonymous' => ($request->anonymous == true) ? 1 : 0,
                    'priority' => $priority,
                    'status' => 'pending',
                ]);

                return response()->json(['success' => true]);
            }
        }
        else if($request->feedback_type == 3){
            Feedback::create([
                'feedbackType_id' => $request->feedback_type,
                'choice' => $request->lecturer_id,
                'comment' => $request->comment,
                'creator_id' => $request->user_id,
                'anonymous' => ($request->anonymous == true) ? 1 : 0,
                'priority' => $priority,
                'status' => 'pending',
            ]);

            return response()->json(['success' => true]);
        }
        else if($request->feedback_type == 4){
            Feedback::create([
                'feedbackType_id' => $request->feedback_type,
                'choice' => $request->service,
                'comment' => $request->comment,
                'creator_id' => $request->user_id,
                'anonymous' => ($request->anonymous == true) ? 1 : 0,
                'priority' => $priority,
                'status' => 'pending',
            ]);

            return response()->json(['success' => true]);
        }
        else{
            return response()->json(['success' => false]);
        }
    }
}
