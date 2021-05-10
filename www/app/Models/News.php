<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
    protected $table = 'news';
	

	/**
     * to maintain relationship with New Category table.
     */
	public function category()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'news_category_id', 'id');
    }

    // Attributes
    public function getNewsDocUrlAttribute()
    {
        $filename = $this->news_doc ?? '';
        $fileurl = empty($filename) ? '' : config('app.url') . config('constants.NEWS_PHOTO_URL') . $filename;
        return $fileurl;
    }
}
