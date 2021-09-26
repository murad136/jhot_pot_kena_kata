<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupn extends Model
{
    use HasFactory;
    protected $fillable = [
    'coupn_code',
    'valid_date',
    'coupn_status',
    'coupn_amount',
    'coupn_type',
];

}
