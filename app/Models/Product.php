<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id_category',
        'name_product',
        'description',
        'stok',
        'unit_items',
        'purchase_price',
        'selling_price',
    ];

    // Relasi ke Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
