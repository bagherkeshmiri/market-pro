<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->tinyInteger('is_active')->default(0)->comment(' 0:no 1:yes ');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('gates_org', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gate_id')->index();
            $table->string('label');
            $table->string('app_key')->nullable();
            $table->tinyInteger('is_active')->default(0)->comment(' 0:no 1:yes ');
            $table->tinyInteger('is_default')->default(0)->comment(' 0:no 1:yes ');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gates_org');
        Schema::dropIfExists('gates');
    }
};
