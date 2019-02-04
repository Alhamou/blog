<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Post extends Model
{

    use SoftDeletes;
    
    protected $table='posts';
    protected $fillable=['title','body'];

    # this "$dates" is allrady set in Laravel .
    protected $dates = ['deleted_at'];



    public function getUser () {
        return $this->belongsTo('App\User','user_id');
    }

}
