<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name');
            $table->unsignedTinyInteger('status')->default(1)->comment(' 1:not_exist , 2:exist ');
            $table->unsignedTinyInteger('discount_type')->default(1)->comment(' 1:percent , 2:amount ');
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->unsignedBigInteger('final_price')->default(0);
            $table->unsignedMediumInteger('stock')->default(0);
            $table->longText('long_description')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('additional_information')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
