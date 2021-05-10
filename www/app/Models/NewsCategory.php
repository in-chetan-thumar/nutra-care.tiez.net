<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    /**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'news_category';
	
	/**
	* to maintain relationship with News table.
	*/
	public function news()
    {
        return $this->hasMany('App\Models\News','news_category_id','id');
    }
    
}
