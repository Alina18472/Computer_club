<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('computer_id')->constrained("computers");
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId("tariff_id")->constrained("tariffs");
            $table->foreignId("code_id")->constrained("codes");
            $table->foreignId("club_id")->constrained("clubs");
            $table->timestamp('start_time');
            $table->timestamp('end_time');
            $table->integer('minutes');
            $table->decimal('price_for_pc', 8, 2);
            $table->decimal('price_for_additions', 8, 2);
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
