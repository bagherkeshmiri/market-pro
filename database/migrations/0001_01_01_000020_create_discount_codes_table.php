<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique();
            $table->enum('type', ['percent', 'amount'])->default('percent');
            $table->unsignedTinyInteger('is_active')->default(0)->comment(' 0:no , 1:yes ');
            $table->unsignedBigInteger('amount');
            $table->unsignedInteger('usage_limit')->default(0);
            $table->unsignedInteger('used_count')->default(0);
            $table->unsignedBigInteger('min_order_amount')->default(500000);
            $table->timestamp('expires_at');
            $table->timestamps();
        });


        Schema::create('discount_code_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('discount_code_id')
                ->constrained('discount_codes')
                ->cascadeOnDelete();

            $table->timestamp('used_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discount_code_user');
        Schema::dropIfExists('discount_codes');
    }
};
