<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $appends = ['category_ids'];

    public $timestamps = false;

    protected $fillable = [
        'category_id',
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
        $fileurl = empty($filename) ? '' : asset(config('constants.PRODUCT_PHOTO_URL') . $filename);
        return $fileurl;
    }

    public function category_product_links()
    {
        return $this->hasMany('App\Models\CategoryProductLink', 'product_id', 'id');
    }
    public function attribute_product_links()
    {
        return $this->hasMany('App\Models\ProductsAttributes', 'product_id', 'id');
    }
    public function getCategoryIdsAttribute()
    {
        return $this->category_product_links->pluck('category_id')->toArray();
    }
    public function getAttributeIdsAttribute()
    {
        return $this->attribute_product_links->pluck('attribute_id')->toArray();
    }
}
