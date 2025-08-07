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
    Schema::create('stock_logs', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->unsignedBigInteger('product_id'); // relasi ke produk
        $table->enum('change_type', ['in', 'out']); // jenis perubahan
        $table->integer('quantity'); // jumlah perubahan stok
        $table->text('description')->nullable(); // keterangan opsional
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // waktu update

        // Optional: foreign key
        // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
