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
        Schema::create('palika_qn_a_s', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('palika_id'); // Foreign Key to palikas
            $table->foreign('palika_id')->references('id')->on('palikas')->cascadeOnDelete();
            $table->text('question'); // The question text
            $table->text('answer'); // The answer text
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('palika_qn_a_s');
    }
};
