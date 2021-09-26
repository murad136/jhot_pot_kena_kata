<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSeting extends Model
{
    use HasFactory;
    use HasFactory;protected $fillable = [
    'currency',
    'phone_one',
    'phone_two',
    'main_email',
    'support_email',
    'address',
    'facebook',
    'youtube',
    'instagram',
    'twitter',
    'linkdin',
    'logo',
    'favicon',
];
}
