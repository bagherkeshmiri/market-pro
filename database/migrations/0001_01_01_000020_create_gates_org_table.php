<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gates_org', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gate_id')->index();
            $table->string('app_key')->nullable();
            $table->tinyInteger('is_enable')->default(1);
            $table->tinyInteger('is_default')->default(0);
            $table->string('label');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gates_org');
    }
};
