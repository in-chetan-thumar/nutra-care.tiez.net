<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class WallpaperComment extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
    protected $table = 'wallpaper_comment';
	

	/**
     * to maintain relationship with Wallpaper Category table.
     */
	public function wallpaper()
    {
        return $this->belongsTo('App\Models\Wallpaper', 'wallpaper_id', 'id');
    }
	
	public function user()
    {
        return $this->belongsTo('App\User', 'created_by', 'id');
    }
    
}
