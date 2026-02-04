<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DebugHelper
{
    /**
     * Check database connection
     */
    public static function checkDatabaseConnection(): array
    {
        try {
            DB::connection()->getPdo();
            return [
                'status' => 'connected',
                'database' => DB::connection()->getDatabaseName(),
            ];
        } catch (\Exception $e) {
            Log::error('Database connection failed', ['error' => $e->getMessage()]);
            return [
                'status' => 'failed',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Check required tables exist
     */
    public static function checkDatabaseTables(): array
    {
        $requiredTables = [
            'users',
            'items',
            'categories',
            'rentals',
            'financial_records',
            'photobooth_events',
            'photobooth_queues',
        ];

        $existing = [];
        $missing = [];

        try {
            $tables = \Illuminate\Support\Facades\Schema::getTables();
            $tableNames = array_map(fn($table) => $table['name'], $tables);

            foreach ($requiredTables as $table) {
                if (in_array($table, $tableNames)) {
                    $existing[] = $table;
                } else {
                    $missing[] = $table;
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to check tables', ['error' => $e->getMessage()]);
        }

        return [
            'existing' => $existing,
            'missing' => $missing,
            'status' => empty($missing) ? 'OK' : 'INCOMPLETE',
        ];
    }

    /**
     * Check file permissions
     */
    public static function checkFilePermissions(): array
    {
        $paths = [
            'storage' => storage_path(),
            'bootstrap_cache' => base_path('bootstrap/cache'),
            'logs' => storage_path('logs'),
        ];

        $results = [];

        foreach ($paths as $name => $path) {
            $isWritable = is_writable($path);
            $results[$name] = [
                'path' => $path,
                'writable' => $isWritable,
                'permissions' => substr(sprintf('%o', fileperms($path)), -4),
            ];

            if (!$isWritable) {
                Log::warning("Directory is not writable: $path");
            }
        }

        return $results;
    }

    /**
     * Check environment variables
     */
    public static function checkEnvironment(): array
    {
        return [
            'app_env' => app()->environment(),
            'app_debug' => config('app.debug'),
            'database' => config('database.default'),
            'cache' => config('cache.default'),
            'queue' => config('queue.default'),
        ];
    }

    /**
     * Generate diagnostic report
     */
    public static function generateDiagnosticReport(): array
    {
        return [
            'timestamp' => now()->toIso8601String(),
            'environment' => self::checkEnvironment(),
            'database' => self::checkDatabaseConnection(),
            'tables' => self::checkDatabaseTables(),
            'permissions' => self::checkFilePermissions(),
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
        ];
    }

    /**
     * Log diagnostic report
     */
    public static function logDiagnosticReport(): void
    {
        $report = self::generateDiagnosticReport();
        Log::info('Diagnostic Report', $report);
    }
}
