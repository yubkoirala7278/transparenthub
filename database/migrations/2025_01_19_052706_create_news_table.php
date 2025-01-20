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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('news_categories_id');
            $table->foreign('news_categories_id')->references('id')->on('news_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('news_sources_id')->nullable();
            $table->foreign('news_sources_id')->references('id')->on('news_sources')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->string('rss')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
