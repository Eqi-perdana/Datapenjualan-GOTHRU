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
    Schema::create('sales', function (Blueprint $table) {
        $table->id(); // bigint(20)
        $table->unsignedBigInteger('user_id'); // relasi ke users
        $table->date('sale_date'); // tanggal penjualan
        $table->decimal('total_amount', 15, 2); // total
        $table->enum('payment_method', ['cash', 'transfer', 'qris']); // enum metode pembayaran
        $table->timestamp('created_at')->useCurrent(); // waktu dibuat
        $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // waktu diubah

        // Optional: foreign key
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

