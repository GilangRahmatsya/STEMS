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
        // Add indexes to rentals table for better performance
        Schema::table('rentals', function (Blueprint $table) {
            $table->index('status');
            $table->index('user_id');
            $table->index('item_id');
            $table->index('created_at');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('payment_status');
            $table->index('pickup_status');
            $table->index('return_status');
            $table->index(['user_id', 'status']); // Composite index
            $table->index(['status', 'created_at']); // Composite index
        });

        // Add indexes to items table
        Schema::table('items', function (Blueprint $table) {
            $table->index('status');
            $table->index('condition');
            $table->index('category_id');
            $table->index(['status', 'condition']); // Composite index
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes from rentals table
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['item_id']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['start_date']);
            $table->dropIndex(['end_date']);
            $table->dropIndex(['payment_status']);
            $table->dropIndex(['pickup_status']);
            $table->dropIndex(['return_status']);
            $table->dropIndex(['user_id', 'status']);
            $table->dropIndex(['status', 'created_at']);
        });

        // Remove indexes from items table
        Schema::table('items', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['condition']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['status', 'condition']);
        });
    }
};
