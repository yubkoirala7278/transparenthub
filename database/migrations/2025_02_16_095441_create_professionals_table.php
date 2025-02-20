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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // user
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
        
            // Category & Subcategory
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('professional_categories')->cascadeOnDelete()->cascadeOnUpdate();
            
            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->references('id')->on('professional_sub_categories')->cascadeOnDelete()->cascadeOnUpdate();
        
            // Professional Basic Info
            $table->string('phone_number');
            $table->string('profile_image'); // Store profile image path
            $table->text('bio'); // Short introduction about the professional
            $table->float('experience_years')->default(0); // Years of experience
        
            // Location Fields
            $table->string('location');
        
            // Additional Attributes
            // $table->json('social_links')->nullable(); // Store social media links, e.g., {"linkedin": "url", "twitter": "url"}
            
            $table->decimal('rating', 3, 2)->default(0.0); // Rating out of 5.00
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
