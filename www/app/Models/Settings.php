<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = "settings";

    protected $fillable = [
        "section_title",
        "field_title",
        "input_type",
        "column",
        "value",
        "rules",
        "section_sort_no",
        "sort_no",
        "created_by",
        "updated_by"
    ];
}
