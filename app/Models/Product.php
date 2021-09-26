<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'categorie_id',
        'subcategorie_id',
        'childcategorie_id',
        'brand_id',
        'pickup_id',
        'name',
        'code',
        'product_slug',
        'unit',
        'tags',
        'color',
        'size',
        'video',
        'purchage_price',
        'selling_price',
        'discount_proce',
        'sku',
        'warehouse',
        'description',
        'thumbnail',
        'image',
        'featured',
        'today_deal',
        'status',
        'flash_deal_id',
        'cash_on_delivery',
        'date',
        'month',
        'admin_id',

    ];

    public function categorie(){
        return $this->belongsTo(Categorie::class,'categorie_id');
    }
    public function subcategorie(){
        return $this->belongsTo(Subcategorie::class,'subcategorie_id');
    }
    public function childcategorie(){
        return $this->belongsTo(Childcategorie::class,'childcategorie_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function pickup(){
        return $this->belongsTo(Pickup::class,'pickup_id');
    }


}
