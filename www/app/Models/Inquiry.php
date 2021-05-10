<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $table="inquiries";
    protected $fillable=[
      'name',
      'email',
      'phone',
      'message',
    ];

    public function inquiry_product_links()
    {
        return $this->hasMany('App\Models\InquiryProductLink','inquiry_id','id');
    }
}
