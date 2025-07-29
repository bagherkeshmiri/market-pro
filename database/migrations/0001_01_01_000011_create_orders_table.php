<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('order_number')->unique();
            $table->unsignedTinyInteger('status')->default(1)->comment(
                ' 1:pending , 2:paid , 3:shipped , 4: cancelled'
            );
            $table->decimal('subtotal', 15);
            $table->decimal('discount', 15)->default(0);
            $table->decimal('tax', 15)->default(0);
            $table->decimal('shipping_fee', 15)->default(0);
            $table->decimal('total', 15);
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->unsignedInteger('qty');
            $table->decimal('unit_price');
            $table->decimal('final_price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
