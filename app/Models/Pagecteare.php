<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagecteare extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_position',
        'page_name',
        'page_title',
        'page_description',
        'page_slug',
    ];
}
