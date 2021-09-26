<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Childcategorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'subcategorie_id',
        'childcategorie_name',
        'childcategorie_slug',

    ];
}
