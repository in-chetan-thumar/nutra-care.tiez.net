<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table="pages";
    public $timestamps = false;

    protected $fillable=[
        "page_title",
        "page_slug",
        "meta_tag",
        "meta_description",
        "page_text",
        "created_by",
        "updated_by",
        "deleted_at"
    ];
}
