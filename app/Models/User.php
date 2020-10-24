<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    public function roles()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Models\Feedback');
    }

    public function faculties()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function notifications()
    {
        return $this->hasManyThrough('App\Models\Feedback', 'App\Models\Notification');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'user_id';
    // protected $guard = 'user';

    protected $fillable = [
        'user_id', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date',
        'user_id' => 'string',
    ];

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
}
