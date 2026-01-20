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
        Schema::table('financial_records', function (Blueprint $table) {
            $table->foreign('photobooth_queue_id')->references('id')->on('photobooth_queues')->onDelete('set null');
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('financial_records', function (Blueprint $table) {
            $table->dropForeign(['photobooth_queue_id']);
            $table->dropForeign(['rental_id']);
        });
    }
};
