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
        Schema::create('photobooth_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photobooth_event_id')->constrained('photobooth_events')->onDelete('cascade');
            $table->string('customer_name');
            $table->integer('strips_ordered');
            $table->string('whatsapp_number');
            $table->decimal('total_amount', 10, 2);
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_photographed')->default(false);
            $table->boolean('is_printed')->default(false);
            $table->boolean('is_ready')->default(false);
            $table->boolean('is_picked_up')->default(false);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('photographed_at')->nullable();
            $table->timestamp('printed_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('picked_up_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photobooth_queues');
    }
};
