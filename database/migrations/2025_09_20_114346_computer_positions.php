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
            $table->string('name')->comment('Название места: 1, 2, 3... 30'); // убрали nullable
            $table->timestamps();

            // Уникальная комбинация ряда и колонки
            $table->unique(['row', 'column']);
            // Уникальное имя места
            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_positions');
    }
};
