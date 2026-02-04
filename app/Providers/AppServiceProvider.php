<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register admin gate
        Gate::define('is-admin', function ($user) {
            return $user->role === 'admin';
        });

        // Auto-login admin for desktop mode (production only)
        if (app()->isProduction() && !auth()->check()) {
            // Check if running in Tauri desktop app
            $userAgent = request()->userAgent();
            if (str_contains($userAgent, 'Tauri') || str_contains($userAgent, 'tauri')) {
                \Illuminate\Support\Facades\Auth::loginUsingId(1); // admin user
            }
        }
    }
}