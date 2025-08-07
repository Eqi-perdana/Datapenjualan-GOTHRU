<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('purchase_items', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->unsignedBigInteger('purchase_id'); // relasi ke purchases
        $table->unsignedBigInteger('product_id'); // relasi ke products
        $table->integer('quantity'); // int(11)
        $table->decimal('price', 15, 2); // harga per unit
        $table->decimal('subtotal', 15, 2); // total = quantity * price

        // timestamps opsional kalau kamu ingin mencatat created_at/updated_at
        $table->timestamps();

        // Foreign key opsional (jika tabel purchases & products sudah ada)
        // $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
        // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_items');
    }
};

