<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'session_id', 'problem_id', 'user_id', 'code', 'result', 'language', 'acm'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function problem()
    {
        return $this->belongsTo('App\Problem');
    }
    public function session()
    {
        return $this->belongsTo('App\Session');
    }
    
}
