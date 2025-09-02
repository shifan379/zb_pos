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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('invoice_no')->unique()->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->string('transaction_no')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropUnique(['invoice_no']);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropUnique(['transaction_no']);
        });
    }
};
