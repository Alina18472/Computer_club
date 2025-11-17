<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_tariffs', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 8, 2);
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->foreignId('booking_id')->constrained('bookings');
            $table->foreignId('tariff_id')->constrained('tariffs');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_tariffs');
    }
};
