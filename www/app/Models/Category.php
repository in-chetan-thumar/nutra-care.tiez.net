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

}
