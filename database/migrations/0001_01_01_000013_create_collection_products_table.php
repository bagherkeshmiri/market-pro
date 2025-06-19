<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collection_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('collection_products');
    }
};
