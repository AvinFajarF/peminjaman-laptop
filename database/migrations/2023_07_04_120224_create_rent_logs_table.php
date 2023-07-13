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
        Schema::create('rent_logs', function (Blueprint $table) {
            $table->id();
            // user relations
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // laptop relations
            $table->unsignedBigInteger('laptop_id');

            $table->foreign('laptop_id')->references('id')->on('laptop')->onDelete('cascade');

            $table->string("return_date");
            $table->string("loan_date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_logs');
    }
};
