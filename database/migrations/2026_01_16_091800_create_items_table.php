<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description')->nullable();
    $table->string('category')->nullable();
    $table->string('condition')->default('Good'); // Bad / Good / Excellent
    $table->string('status')->default('Ready');   // Ready / Not Ready
    $table->string('location')->nullable();
    $table->decimal('buy_price', 10, 2)->nullable();
    $table->decimal('rent_price', 10, 2)->nullable();
    $table->string('image')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
