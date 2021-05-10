<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccessToken extends Model
{
    protected $table = 'user_access_token';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
