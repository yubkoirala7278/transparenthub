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
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->unsignedBigInteger('user_id');  //patient
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('professional_id');  //professional
            $table->foreign('professional_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('schedule_id');  //professional schedule
            $table->foreign('schedule_id')->references('id')->on('professional_schedules')->cascadeOnDelete();

            $table->longText('visit_reason')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email_address');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appoinments');
    }
};
