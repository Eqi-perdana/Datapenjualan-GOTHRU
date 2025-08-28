<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPriceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price_type',
        'price',
        'changed_by',
        'change_reason',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    // Relasi ke produk
    // app/Models/ProductPriceHistory.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi ke user yang mengubah
    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
