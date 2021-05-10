<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDeviceDetails extends Model
{
    protected $table = 'user_device_details';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
