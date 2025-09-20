<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_positions', function (Blueprint $table) {
            $table->id();
            $table->integer('row');
            $table->integer('column');
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_positions');
    }
};
