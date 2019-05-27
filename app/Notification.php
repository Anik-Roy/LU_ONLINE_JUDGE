<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
      'post_id',
      'user_id',
      'from_user_id',
      'is_seen',
      'body'
    ];
    protected $table = 'notifications';
}
