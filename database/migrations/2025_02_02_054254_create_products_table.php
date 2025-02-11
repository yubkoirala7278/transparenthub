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
            $table->string('slug')->unique();
            $table->string('name');
            $table->longText('description');

            $table->decimal('price', 10, 2);
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->string('feature_image');
            $table->string('sku')->unique();

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('product_categories')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->foreign('sub_category_id')->references('id')->on('product_sub_categories')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('product_brands')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')->references('id')->on('product_colors')->cascadeOnDelete()->cascadeOnUpdate();

            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('product_sizes')->cascadeOnDelete()->cascadeOnUpdate();

            $table->enum('is_featured',['Yes','No'])->default('Yes');

            $table->boolean('track_qty')->default(false);
            $table->integer('qty')->nullable();
            
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->longText('shipping_returns')->nullable();

            $table->decimal('shipping_charge_inside_valley',10, 2)->default(0);
            $table->decimal('shipping_charge_outside_valley',10,2)->default(0);


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
