<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_positions', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->decimal('coefficient', 8, 2);
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('club_id')->constrained('clubs');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_positions');
    }
};
