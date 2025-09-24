<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

        Schema::create('additional_menu', function (Blueprint $table) {
            $table->foreignId('booking_id')->constrained("bookings");
            $table->foreignId('food_id')->constrained("foods");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('additional_menu');
    }
};
