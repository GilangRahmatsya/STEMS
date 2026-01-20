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
        Schema::table('rentals', function (Blueprint $table) {
            // Payment and status tracking
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid')->after('status');
            $table->enum('pickup_status', ['picked_up', 'not_picked_up'])->default('not_picked_up')->after('payment_status');
            $table->enum('return_status', ['returned', 'not_returned'])->default('not_returned')->after('pickup_status');

            // Borrower credentials
            $table->string('borrower_name')->nullable()->after('return_status');
            $table->date('borrower_birth_date')->nullable()->after('borrower_name');
            $table->text('purpose')->nullable()->after('borrower_birth_date');

            // KTP handling
            $table->enum('ktp_status', ['received', 'returned', 'not_received'])->default('not_received')->after('purpose');
            $table->text('ktp_notes')->nullable()->after('ktp_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn([
                'payment_status',
                'pickup_status',
                'return_status',
                'borrower_name',
                'borrower_birth_date',
                'purpose',
                'ktp_status',
                'ktp_notes'
            ]);
        });
    }
};
