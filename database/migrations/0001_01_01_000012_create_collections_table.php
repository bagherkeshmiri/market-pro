<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index()->nullable();
            $table->string('title')->nullable();
            $table->unsignedTinyInteger('type')->default(1)->comment(' 1 => product , 2 => banner , 3 => slider , 4 => box ');
            $table->unsignedTinyInteger('limitation')->nullable();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
