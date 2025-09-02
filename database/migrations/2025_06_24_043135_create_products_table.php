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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('location')->nullable();
            $table->string('product_name');
            $table->string('slug')->nullable();
            $table->string('sku')->nullable();
            $table->string('selling_type')->nullable();
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('brand')->nullable();
            $table->string('unit')->nullable();
            $table->string('item_code')->nullable();
            $table->string('product_description')->nullable();
            $table->string('mark')->nullable();
            $table->integer('product_type')->nullable()->comment('1 => single product, 2 => variable products. its for add mulitypule items using same name');

            // if single product
            $table->string('quantity')->nullable();
            $table->decimal('buying_price',15, 2)->nullable();
            $table->decimal('selling_price',15, 2)->nullable();
            $table->decimal('average_cost_price', 15, 2)->nullable();
            $table->decimal('wholesale_price', 15, 2)->nullable();
            $table->decimal('online_price', 15, 2)->nullable();
            $table->string('tax_type')->nullable();
            $table->string('tax')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('quantity_alert')->nullable();

            //if mulity products
            $table->string('variantion_name')->nullable();
            $table->string('variantion_value')->nullable();

            $table->json('images')->nullable();
            $table->integer('warranty')->nullable();
            $table->string('manufacturer')->nullable();
            $table->date('manufacturer_date')->nullable();
            $table->date('expiry_date')->nullable();

            // Seller
            $table->integer('supplier_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
