<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('donator_name');
            $table->string('email')->nullable();
            $table->string('message');
            $table->decimal('amount', 10, 2);
            $table->boolean('anonymous')->default(false);
            $table->enum('status', ['pending', 'waiting_for_capture', 'succeeded', 'canceled'])->default('pending');
            $table->string('payment_id')->nullable()->unique();
            $table->text('payment_data')->nullable();
            $table->string('return_token')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};