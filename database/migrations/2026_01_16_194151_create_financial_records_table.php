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
        Schema::create('financial_records', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'income' or 'expense'
            $table->string('category'); // e.g., 'photobooth', 'rental', 'maintenance', etc.
            $table->string('description');
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->unsignedBigInteger('photobooth_queue_id')->nullable();
            $table->unsignedBigInteger('rental_id')->nullable();
            $table->timestamps();

            // Add foreign key constraints separately after all tables are created
            // $table->foreign('photobooth_queue_id')->references('id')->on('photobooth_queues')->onDelete('set null');
            // $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_records');
    }
};
