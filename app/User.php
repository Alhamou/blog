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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPost(){

 
        return $this->hasOne('App\Post'); # Py Default is ('App\Post', 'user_id'); 

    }

    public function getPosts(){

        return $this->hasMany('App\Post'); # Py Default is ('App\Post', 'user_id'); 

    }

    public function roles (){

        return $this->belongsToMany('App\Role');
    }


}
