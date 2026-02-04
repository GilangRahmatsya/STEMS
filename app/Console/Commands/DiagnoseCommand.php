<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiagnoseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:diagnose';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose STEMS application health and configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Running STEMS Diagnostic...' . "\n");

        // Check database connection
        $this->checkDatabase();
        $this->newLine();

        // Check file permissions
        $this->checkPermissions();
        $this->newLine();

        // Check environment
        $this->checkEnvironment();
        $this->newLine();

        // Check required tables
        $this->checkTables();
        $this->newLine();

        $this->info('✨ Diagnostic complete!');
    }

    protected function checkDatabase()
    {
        $this->info('🗄️  Database Connection:');

        try {
            DB::connection()->getPdo();
            $this->line('  ✅ Connected');
            $this->line('  • Database: ' . config('database.connections.' . config('database.default') . '.database'));
        } catch (\Exception $e) {
            $this->error('  ❌ Failed: ' . $e->getMessage());
            Log::error('Database connection failed', ['error' => $e->getMessage()]);
        }
    }

    protected function checkPermissions()
    {
        $this->info('🔐 File Permissions:');

        $paths = [
            'storage' => storage_path(),
            'bootstrap/cache' => base_path('bootstrap/cache'),
            'logs' => storage_path('logs'),
        ];

        foreach ($paths as $name => $path) {
            $writable = is_writable($path);
            $status = $writable ? '✅' : '❌';
            $perms = substr(sprintf('%o', fileperms($path)), -4);
            $this->line("  {$status} {$name} ({$perms})");
        }
    }

    protected function checkEnvironment()
    {
        $this->info('⚙️  Environment:');

        $this->line('  • App Env: ' . app()->environment());
        $this->line('  • Debug: ' . (config('app.debug') ? 'On' : 'Off'));
        $this->line('  • Database: ' . config('database.default'));
        $this->line('  • PHP: ' . phpversion());
        $this->line('  • Laravel: ' . app()->version());
    }

    protected function checkTables()
    {
        $this->info('📊 Database Tables:');

        $required = ['users', 'items', 'categories', 'rentals', 'financial_records'];

        try {
            $tables = \Illuminate\Support\Facades\Schema::getTables();
            $tableNames = array_map(fn($table) => $table['name'], $tables);

            foreach ($required as $table) {
                $exists = in_array($table, $tableNames);
                $status = $exists ? '✅' : '❌';
                $this->line("  {$status} {$table}");
            }
        } catch (\Exception $e) {
            $this->error('  Error checking tables: ' . $e->getMessage());
        }
    }
}
