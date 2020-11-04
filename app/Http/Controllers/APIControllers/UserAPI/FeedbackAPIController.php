<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
Use Sentiment\Analyzer;
use Symfony\Component\HttpFoundation\File\File;
use Illuminate\Support\Facades\DB;

class FeedbackAPIController extends Controller
{
    public function index(Request $request)
    {
        if($request->priority == null){
            if($request->type != 0){
                return Feedback::where('feedbacks.status', 'pending')
                    ->where('feedbackType_id', intval($request->type))
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->select('feedbacks.*', 'feedback_types.type')
                    ->get();
            }
            else{
                return Feedback::where('feedbacks.status', 'pending')
                        ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                        ->select('feedbacks.*', 'feedback_types.type')
                        ->get();
            }
        }

        return Feedback::where('feedbacks.status', 'pending')
                ->where('priority', $request->priority)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
    }

    public function accepted(Request $request){
        if($request->id != null){
            if($request->action == 'approved'){
                return Feedback::where('feedbacks.status', 'approved')
                        ->where('feedbacks.handler_id', $request->id)
                        ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                        ->select('feedbacks.*', 'feedback_types.type')
                        ->get();
            }
            else if($request->action == 'urgent'){
                return Feedback::where('feedbacks.status', 'urgent')
                        ->where('feedbacks.handler_id', $request->id)
                        ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                        ->select('feedbacks.*', 'feedback_types.type')
                        ->get();
            }
            else{
                return response()->json([
                    'error' => 'Feedback Not Found.',
                ]);
            }
        }

        return response()->json([
            'error' => 'Feedback Not Found.',
        ]);
    }

    public function history(Request $request){
        if($request->id != null){
            if($request->type == 1){
                return Feedback::where('feedbackType_id', '1')
                ->where(function($query){
                    $query->where('feedbacks.status', 'solved')
                        ->orWhere('feedbacks.status', 'dismissed');
                })
                ->where('feedbacks.handler_id', $request->id)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*','feedback_types.type')
                ->get();
            }
            else if($request->type == 2){
                return Feedback::where('feedbackType_id', '2')
                ->where(function($query){
                    $query->where('feedbacks.status', 'solved')
                        ->orWhere('feedbacks.status', 'dismissed');
                })
                ->where('feedbacks.handler_id', $request->id)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
            }
            else if($request->type == 3){
                return Feedback::where('feedbackType_id', '3')
                ->where(function($query){
                    $query->where('feedbacks.status', 'solved')
                        ->orWhere('feedbacks.status', 'dismissed');
                })
                ->where('feedbacks.handler_id', $request->id)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
            }
            else if($request->type == 4){
                return Feedback::where('feedbackType_id', '4')
                ->where(function($query){
                    $query->where('feedbacks.status', 'solved')
                        ->orWhere('feedbacks.status', 'dismissed');
                })
                ->where('feedbacks.handler_id', $request->id)
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();
            }
            else{
                return Feedback::where('feedbacks.status', 'solved')
                        ->where('feedbacks.handler_id', $request->id)
                        ->orWhere('feedbacks.status', 'dismissed')
                        ->where('feedbacks.handler_id', $request->id)
                        ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                        ->select('feedbacks.*', 'feedback_types.type')
                        ->get();
            }
        }

        return response()->json(['error' => true]);
    }

    public function userHistory(Request $request){
        if($request->id != null){
            if($request->feedback != null){
                return Feedback::where('feedbackType_id', intval($request->feedback))
                    ->where('creator_id', $request->id)
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->join('users', 'feedbacks.creator_id', '=', 'users.user_id')
                    ->select('feedbacks.*', 'users.name', 'users.image','feedback_types.type')
                    ->get();
            }
            else{
                return Feedback::where('creator_id', $request->id)
                    ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                    ->join('users', 'feedbacks.creator_id', '=', 'users.user_id')
                    ->select('feedbacks.*', 'users.name', 'users.image','feedback_types.type')
                    ->get();
            }
        }
        else{
            return json_encode(array(
                "message" => 'Unauthenticated.',
                'success' => false,
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

            return response()->json([
                'message' => 'Feedback dismissed successfully.',
                'success' => true,
            ]);
        }
        else if($request->action == 'approve'){
            Feedback::where('id',$request->id)
                ->update([
                    'status' => 'approved',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);

            return response()->json([
                'message' => 'Feedback approved successfully.',
                'success' => true,
            ]);
        }
        else if($request->action == 'urgent'){
            Feedback::where('id',$request->id)
                ->update([
                    'status' => 'urgent',
                    'approved_date' => \Carbon\Carbon::now()->toDateTimeString(),
                    'handler_id' => $request->user_id,
                ]);

            return response()->json([
                'message' => 'Feedback approved successfully.',
                'success' => true,
            ]);
        }
        else if($request->action == 'recall'){
            Feedback::where('id',$request->id)
                ->update(['status' => 'recalled']);

            return response()->json([
                'message' => 'Feedback recalled successfully.',
                'success' => true,
            ]);
        }
        else if($request->action == 'solve'){
            Feedback::where('id',$request->id)
                ->update(['status' => 'solved']);

            return response()->json([
                'message' => 'Feedback solved successfully.',
                'success' => true,
            ]);
        }
        else{
            return response()->json([
                'message' => 'Invalid Action.',
                'success' => false,
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
            $imageName = Str::random(50).'.'.str_replace("image/","",$mime_type);
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

    public function retrieveUser(Request $request){
        if($request->id != null){
            $user = DB::table('users')->select('users.*')->where('users.user_id', $request->id)->first();
            return response()->json([
                'user_id' => $user->user_id,
                'name' => $user->name,
                'image' => $user->image,
            ]);
        }
        return response()->json([
            'user_id' => null,
        ]);
    }
}
