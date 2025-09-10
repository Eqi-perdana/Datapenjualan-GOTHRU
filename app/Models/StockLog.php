<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockLog extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     *
     * @var string
     */
    protected $table = 'stock_logs';

    /**
     * Kolom yang bisa diisi
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'change_type',
        'quantity',
        'description',
    ];

    /**
     * Nonaktifkan timestamps (created_at & updated_at)
     *
     * Kalau tabel stock_logs memang tidak punya kolom created_at dan updated_at
     * set ini ke false. Tapi kalau tabel ada kolomnya, hapus properti ini.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Relasi ke Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
