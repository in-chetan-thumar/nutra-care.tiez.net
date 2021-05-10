<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFavoriteWallpaper extends Model
{
    protected $table = 'user_favorite_wallpaper';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
	
	public function wallpaper(){
        return $this->belongsTo('App\Models\Wallpaper','wallpaper_id','id');
    }
}
