<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
        'brand',
        'description',
        'price',
        'stock',
        'category',
        'discount',
    ];

    public function photos(){
        return $this->hasMany(ProductGalleries::class, 'product_id', 'id');
    }
}
