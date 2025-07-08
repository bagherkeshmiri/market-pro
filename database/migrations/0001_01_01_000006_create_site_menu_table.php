<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('key');
            $table->string('value');
            $table->unsignedTinyInteger('is_active')->default(0)->comment(' 0 => no , 1 => yes ');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_menus');
    }
};
