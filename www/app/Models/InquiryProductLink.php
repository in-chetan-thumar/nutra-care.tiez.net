<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryProductLink extends Model
{
    use HasFactory;

    protected $table="inquiry_product_links";

    protected $fillable=[
        'inquiry_id',
        'product_id',
        'attribute_id',
    ];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsTo('App\Models\Attributes', 'attribute_id', 'id');
    }

}
