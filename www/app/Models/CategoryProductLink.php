<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProductLink extends Model
{
    use HasFactory;

    protected $table = "category_product_links";
    protected $fillable = [
        'category_id',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }
}
