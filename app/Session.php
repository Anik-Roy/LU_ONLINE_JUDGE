<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = [
        'name', 'course_id', 'user_id', 'batch', 'section', 'hash_code', 'session_id'
    ];

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\SessionUser', 'session_id', 'id', 'id', 'user_id');
    }
    public function accepted()
    {
        return $this->hasMany('App\Accepted');
    }
    public function tried()
    {
        return $this->hasMany('App\Tried');
    }
    public function problems()
    {
        return $this->hasManyThrough(Problem::class, SessionProblem::class, 'session_id', 'id', 'id', 'problem_id');
    }
}
