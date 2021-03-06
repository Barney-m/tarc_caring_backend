<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $dateFormat = 'Y-m-d';

    protected $fillable = [
        'feedbackType_id', 'choice', 'comment', 'attachment', 'creator_id', 'handler_id', 'anonymous', 'priority', 'status', 'approved_date', 'dismiss_date',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'approved_date' => 'datetime:Y-m-d H:i:s',
        'dismiss_date' => 'datetime:Y-m-d H:i:s',
    ];

    public function creators()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public function handler()
    {
        return $this->belongsTo('App\Models\User', 'handler_id');
    }

    public function feedback_types()
    {
        return $this->belongsTo('App\Models\FeedbackType');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Role');
    }

    public function attachment(){
        return $this->file();
    }
}
