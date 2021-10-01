<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'photo',
        'slug',
        'parent_category_id',
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    // Attributes
    public function getPhotoUrlAttribute()
    {
        $filename = $this->photo ?? '';
        $fileurl = empty($filename) ? '' : asset(config('constants.CATEGORY_PHOTO_URL') . $filename);
        return $fileurl;
    }

    public function category_product_links()
    {
        return $this->hasMany('App\Models\CategoryProductLink','category_id','id');
    }

    public function chaild_category()
    {
        return $this->hasMany('App\Models\Category','parent_category_id','id');
    }
    public function category_products()
    {
        $total_link_products = 0;
        //$total_link_products = $this->category_product_links->count();
        if(!empty($this->chaild_category)){
            foreach($this->chaild_category as $subCategory){
                $total_link_products += $subCategory->category_product_links->count();
            }
        }
        return $total_link_products;
    }
}
