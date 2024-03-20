<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $table="contact_us";
    protected $fillable=[
        "name",
        "email",
        "phone",
        "comment",
        "product_type",
        "created_by",
        "updated_by",
        "deleted_at",
        "deleted_by",
        "replay",
    ];
}
