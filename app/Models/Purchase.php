<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'user_id',
        'purchase_date',
        'total_amount',
    ];

   public function supplier()
{
    return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
}

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
