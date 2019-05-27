<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'course_id', 'author_id', 'session_id', 'title', 'time_limit', 'memory_limit', 'body', 'input_sec', 'output_sec', 'level', 'acm'
    ];

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
    public function inputoutput()
    {
        return $this->hasMany('App\InputOutput');
    }
    public function accepted()
    {
        return $this->hasMany('App\Accepted');
    }
    public function accepted_submissions()
    {
        return $this->hasManyThrough('App\Submission', 'App\Accepted');
    }
    public function tried()
    {
        return $this->hasMany('App\tried');
    }
}
