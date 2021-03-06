<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackType extends Model
{
    use HasFactory;

    protected $table = 'feedback_types';

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }
}
