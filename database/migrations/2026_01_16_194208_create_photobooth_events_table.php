<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('photobooth_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('strips_count'); // number of strips per package
            $table->decimal('price_per_strip', 10, 2); // price per strip
            $table->decimal('total_price', 10, 2); // calculated total price
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photobooth_events');
    }
};
