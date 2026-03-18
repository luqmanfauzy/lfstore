<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('shipping_cost', 15, 2)->default(0)->after('total_purchases');
            $table->string('payment_method')->default('cod')->after('shipping_cost');
        });
    }

    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['shipping_cost', 'payment_method']);
        });
    }
};
