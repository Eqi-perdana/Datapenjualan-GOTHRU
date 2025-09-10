<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id(); // Primary key (bigint unsigned auto increment)
            $table->string('name_suppliers', 225); // Nama supplier
            $table->string('contact', 225); // Nomor telepon atau email
            $table->text('address')->nullable(); // Alamat, bisa kosong
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse / rollback migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
