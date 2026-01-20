<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update rent_price with data from rental_price where rent_price is 0
        DB::statement('UPDATE items SET rent_price = rental_price WHERE rent_price = 0 OR rent_price IS NULL');

        // Drop the duplicate rental_price column
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('rental_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->decimal('rental_price', 12, 2)->default(0)->after('buy_price');
        });

        // Note: Data cannot be fully restored as rental_price data is moved to rent_price
    }
};
