<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedTinyInteger('type')->default(1)->comment(' 1:product , 2:category');
            $table->unsignedTinyInteger('limitation')->nullable();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });


        Schema::create('collection_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->timestamps();
        });


        Schema::create('collection_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('collection_categories');
        Schema::dropIfExists('collection_products');
        Schema::dropIfExists('collections');
    }
};
