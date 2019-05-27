<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionProblem extends Model
{
    protected $fillable = [
        'session_id', 'problem_id'
    ];
    public function problems()
    {
        return $this->belongsTo('App\Problem');
    }
}
