<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming a user can leave a review
            $table->foreignId('car_id')->constrained()->onDelete('cascade'); // Assuming the review is for a car
            $table->integer('rating'); // Rating out of 5
            $table->text('review'); 
            $table->text('reviewHeading');// Review text
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
