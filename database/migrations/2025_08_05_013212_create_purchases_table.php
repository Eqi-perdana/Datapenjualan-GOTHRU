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
    Schema::create('purchases', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->unsignedBigInteger('id_supplier'); // relasi ke supplier
        $table->unsignedBigInteger('id_user'); // relasi ke user (admin yang mencatat)
        $table->date('purchase_date'); // tanggal pembelian
        $table->decimal('total_amount', 15, 2); // total jumlah
        $table->timestamp('created_at')->useCurrent();
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        // Optional: foreign key constraints
        // $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('cascade');
        // $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
