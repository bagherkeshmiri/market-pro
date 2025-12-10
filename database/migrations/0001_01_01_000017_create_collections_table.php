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
            $table->enum('type', ['product', 'category'])->default('product');
            $table->unsignedTinyInteger('limitation')->nullable();
            $table->unsignedTinyInteger('sort')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment(' 0:active , 1:not_active ');
            $table->timestamps();
        });


        Schema::create('collection_products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->timestamps();
        });


        Schema::create('collection_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

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
