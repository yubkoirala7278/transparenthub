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
        Schema::create('palikas', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts')->cascadeOnDelete();

            $table->string('name');

            $table->integer('population');
            $table->decimal('total_area', 10, 2); // in square km

            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palikas');
    }
};
