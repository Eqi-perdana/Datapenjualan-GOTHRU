<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi (mass assignment).
     *
     * @var array
     */
    protected $fillable = [
        'name_suppliers',
        'contact',
        'address',
    ];
}
