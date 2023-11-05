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
            $table->id();
            $table->unsignedBigInteger('saleId');
            $table->unsignedBigInteger('customer_id');
            $table->string('payment_type')->default('cash');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('discount', 12, 2)->default(0);
            $table->text('detail')->nullable();
            $table->decimal('advance',12,2)->default(0);
            $table->decimal('paid',12,2)->default(0);
            $table->decimal('remaining',12,2)->default(0);
            $table->enum('status',['Pending','Partial-pending','Completed','Closed'])->default('Pending');
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
