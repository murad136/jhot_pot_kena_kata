<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'subcategorie_name',
        'subcategorie_slug',

    ];

}
