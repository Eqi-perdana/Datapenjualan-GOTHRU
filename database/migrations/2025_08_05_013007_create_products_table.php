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
    Schema::create('products', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->unsignedBigInteger('id_category'); // relasi ke kategori
        $table->string('name_product', 225); // varchar(225)
        $table->text('description')->nullable(); // boleh kosong
        $table->integer('stok')->default(0); // int(11)
        $table->enum('unit_items', ['kg']); // enum satuan (bisa tambah kalau perlu)
        $table->decimal('purchase_price', 15, 2); // decimal
        $table->decimal('selling_price', 15, 2); // decimal
        $table->timestamp('created_at')->useCurrent(); // timestamp
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // timestamp

        // Foreign key (jika ada tabel categories)
        // $table->foreign('id_category')->references('id')->on('categories')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};