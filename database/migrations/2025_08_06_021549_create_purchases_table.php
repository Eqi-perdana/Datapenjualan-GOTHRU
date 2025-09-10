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
    $table->id();
    $table->unsignedBigInteger('supplier_id');
    $table->unsignedBigInteger('user_id');
    $table->dateTime('purchase_date');
    $table->decimal('total_amount', 15, 2);
    $table->timestamps();

    $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
