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
        Schema::table('products', function (Blueprint $table) {
            //
             $table->renameColumn('service', 'free_service_count')->default(0);
             $table->integer('free_service_duration')->nullable(); // in days
        });

        Schema::create('customer_product_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id'); // reference to the sold product
            $table->foreignId('customer_id');
            $table->integer('used_services')->default(0);
            $table->date('valid_until');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
             $table->renameColumn('free_service_count', 'service');
        });
    }
};
