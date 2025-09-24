<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('computer_specs', function (Blueprint $table) {
            $table->id();
            $table->string('ram');
            $table->string('processor');
            $table->string('gpu');
            $table->string('monitor');
            $table->string('headphones');
            $table->string('mouse');
            $table->string('keyboard');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('computer_specs');
    }
};
