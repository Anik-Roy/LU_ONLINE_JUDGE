<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'solved',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function submissions(){
        return $this->hasMany('App\Submission');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
    // public function sessions(){
    //     return $this->hasMany('App\SessionUser');
    // }
    
    public function sessions(){
        return $this->hasManyThrough('App\Session', 'App\SessionUser', 'user_id', 'id', 'id', 'session_id');
    }
    public function accepteds(){
        return $this->hasManyThrough('App\Accepted', 'App\Submission');
    }
    public function trieds(){
        return $this->hasManyThrough('App\Tried', 'App\Submission');
    }

}
