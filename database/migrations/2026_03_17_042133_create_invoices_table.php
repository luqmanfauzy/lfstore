<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->date('date')->index();
            $table->string('customer_name');
            $table->decimal('total_purchases', 15, 2)->default(0);
            $table->decimal('shipping_cost', 15, 2)->default(0);
            $table->string('discount_name')->nullable();
            $table->decimal('discount_nominal', 15, 2)->default(0);
            $table->string('payment_method')->default('cod');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
