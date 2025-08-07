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
    Schema::create('categories', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->string('name', 225); // nama kategori
        $table->text('description')->nullable(); // deskripsi opsional
        $table->timestamp('created_at')->useCurrent(); // waktu dibuat
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // waktu update
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
