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
    public function product(){
        return $this->hasMany(Product::class, 'category_id', 'id');

    }
    public function category_product_links()
    {
        return $this->hasMany(CategoryProductLink::class,'category_id','id');
    }


    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class, 'parent_category_id', 'id');
    }

    public function subSubCategory()
    {
        return $this->subCategory()->with('subSubCategory');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_category_id','id');
    }

    public function supCategory()
    {
        return $this->parent()->with('supCategory');
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_category_id')->whereDoesntHave('category_product_links');
    }


}
