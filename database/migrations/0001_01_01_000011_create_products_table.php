<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['not_exist', 'exist'])->default('not_exist');
            $table->enum('discount_type', ['percent', 'amount'])->default('percent');
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('final_price')->default(0);
            $table->unsignedMediumInteger('stock')->default(0);
            $table->longText('long_description')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('additional_information')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
