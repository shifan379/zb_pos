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
        Schema::table('return_logs', function (Blueprint $table) {
            //
            $table->foreignId('orderID')->nullable();
            $table->foreignId('orginal_order_id')->nullable();
            $table->foreignId('productID')->nullable();
            $table->integer('return_qty')->default(0);
            $table->decimal('return_net_price')->nullable();
             $table->decimal('discount')->default(0.00);
            $table->decimal('total')->default(0.00);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('return_logs', function (Blueprint $table) {
            //
        });
    }
};
