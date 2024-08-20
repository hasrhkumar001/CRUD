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
        Schema::table('cars', function (Blueprint $table) {
            $table->id();
            $table->string('car_name');
            $table->string('brand');
            $table->string('engine_capacity');
            $table->string('fuel_type');
            $table->string('car_img');
            $table->string('transmission_type');
            $table->string('car_desc');
            $table->string('car_mileage');
            $table->string('car_price_range');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
