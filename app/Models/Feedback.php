<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

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
