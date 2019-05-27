<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tried extends Model
{
    protected $fillable = [
        'problem_id', 'submission_id', 'session_id', 'user_id'
    ];
    public function session()
    {
        return $this->belongsTo('App\Session');
    }
}
