<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputOutput extends Model
{
    protected $fillable = [
        'problem_id', 'input', 'output', 'sample'
    ];
}
