<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('gate_id')
                ->nullable()
                ->constrained('gates')
                ->nullOnDelete();

            $table->string('payment_number', 20)->unique();
            $table->unsignedTinyInteger('status')->default(1)->comment(' 1:unSuccess , 2:success ');
            $table->decimal('amount', 10);
            $table->string('ref_id')->nullable();
            $table->string('authority')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expire_time');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
