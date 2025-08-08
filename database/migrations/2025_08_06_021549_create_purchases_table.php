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
        $table->id(); // id bigint [pk, increment]
        $table->foreignId('supplier_id')->constrained('suppliers'); // supplier_id bigint [ref: > suppliers.id]
        $table->foreignId('user_id')->constrained('users'); // user_id bigint [ref: > users.id]
        $table->date('purchase_date'); // purchase_date date
        $table->decimal('total_amount', 15, 2); // total_amount decimal(15,2)
        $table->timestamps(); // created_at & updated_at timestamp
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
