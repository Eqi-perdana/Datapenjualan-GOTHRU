<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Jadikan kolom product_id nullable agar insert tidak gagal
            $table->unsignedBigInteger('product_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            // Kembalikan NOT NULL jika rollback
            $table->unsignedBigInteger('product_id')->nullable(false)->change();
        });
    }
};
