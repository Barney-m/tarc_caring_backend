<?php

namespace App\Http\Controllers\APIControllers\UserAPI;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeedbackAPIController extends Controller
{
    public function index()
    {
        $arr = Feedback::where('status', 'pending')
                ->join('feedback_types', 'feedbacks.feedbackType_id', '=', 'feedback_types.id')
                ->select('feedbacks.*', 'feedback_types.type')
                ->get();

        // $temp = json_decode($arr ,true);
        // $tempJSON = array();
        // foreach($temp as $t){
        //     $temp_feedback_id = $t["feedback_id"];
        //     $temp_feedbackType_id = $t["feedbackType_id"];
        //     $temp_choice = $t["choice"];
        //     $temp_comment = $t["comment"];
        //     $path = "public\images\\".$t["attachment"];
        //     $temp_attachment = base64_encode(Storage::get($path));
        //     $temp_creator_id = $t["creator_id"];
        //     $temp_handler_id = $t["handler_id"];
        //     $temp_anonymous = $t["anonymous"];
        //     $temp_status = $t["status"];
        //     $temp_created_at = $t["created_at"];
        //     $temp_updated_at = $t["updated_at"];
        //     $temp_approved_date = $t["approved_date"];
        //     $temp_dismiss_date = $t["dismiss_date"];
        //     $temp_type = $t["type"];

        //     $temp_array = array(
        //         "feedback_id" => $temp_feedback_id,
        //         "feedbackType_id" => $temp_feedbackType_id,
        //         "choice" => $temp_choice,
        //         "comment" => $temp_comment,
        //         "attachment" => $temp_attachment,
        //         "creator_id" => $temp_creator_id,
        //         "handler_id" => $temp_handler_id,
        //         "anonymous" => $temp_anonymous,
        //         "status" => $temp_status,
        //         "created_at" => $temp_created_at,
        //         "updated_at" => $temp_updated_at,
        //         "approved_date" => $temp_approved_date,
        //         "dismiss_date" => $temp_dismiss_date,
        //         "type" => $temp_type,
        //     );

        //     array_push($tempJSON, $temp_array);
        // }

        return $arr;
    }

    public function getPending(){

    }
}
