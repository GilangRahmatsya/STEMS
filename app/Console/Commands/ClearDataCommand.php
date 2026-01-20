<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:clear {--force : Skip confirmation prompt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all rental data, financial records, and analytics logs';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->option('force') && !$this->confirm('This will permanently delete all rental data, financial records, and analytics logs. Are you sure?')) {
            $this->info('Operation cancelled.');
            return;
        }

        $this->info('Starting data cleanup...');

        // Clear rentals (this will also clear total spent)
        $rentalCount = \App\Models\Rental::count();
        \App\Models\Rental::truncate();
        $this->info("Cleared {$rentalCount} rental records");

        // Clear financial records (analytics logs)
        $financialCount = \App\Models\FinancialRecord::count();
        \App\Models\FinancialRecord::truncate();
        $this->info("Cleared {$financialCount} financial records");

        // Clear photobooth data
        $eventCount = \App\Models\PhotoboothEvent::count();
        \App\Models\PhotoboothEvent::truncate();
        $this->info("Cleared {$eventCount} photobooth events");

        $queueCount = \App\Models\PhotoboothQueue::count();
        \App\Models\PhotoboothQueue::truncate();
        $this->info("Cleared {$queueCount} photobooth queues");

        // Clear cache to ensure stats are recalculated
        \Illuminate\Support\Facades\Cache::flush();
        $this->info('Cleared application cache');

        $this->info('Data cleanup completed successfully!');
        $this->warn('All rental data, financial records, and analytics logs have been permanently deleted.');
    }
}
