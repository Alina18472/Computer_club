<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_positions', function (Blueprint $table) {
            $table->id();
            $table->integer("number");
            $table->decimal('coefficient', 8, 2);
            $table->integer('position_x');
            $table->integer('position_y');
            $table->foreignId('room_id')->constrained('rooms');
            $table->foreignId('club_id')->constrained('clubs');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE computer_positions ADD CONSTRAINT chk_position_x CHECK (position_x BETWEEN 1 AND 6)');
        DB::statement('ALTER TABLE computer_positions ADD CONSTRAINT chk_position_y CHECK (position_y BETWEEN 1 AND 6)');

    }

    public function down(): void
    {
        Schema::dropIfExists('computer_positions');
    }
};
