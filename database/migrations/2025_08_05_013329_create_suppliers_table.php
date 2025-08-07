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
    Schema::create('suppliers', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->string('name_suppliers', 225); // nama supplier
        $table->string('contact', 225); // nomor telepon atau email
        $table->text('address')->nullable(); // alamat, bisa kosong
        $table->timestamp('created_at')->useCurrent(); // waktu dibuat
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // waktu update
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};