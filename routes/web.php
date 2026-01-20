<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Items;
use App\Livewire\Rentals;
use App\Livewire\CreateRental;
use App\Livewire\CreateBulkRental;
use App\Livewire\PhotoboothQueues;
use App\Livewire\Financial;
use App\Livewire\Reports;
use App\Livewire\Analytics;
use App\Livewire\Admin\Items as AdminItems;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Rentals as AdminRentals;
use App\Livewire\Admin\Reports as AdminReports;
use App\Livewire\Admin\Analytics as AdminAnalytics;
use App\Livewire\Admin\Financial as AdminFinancial;
use App\Livewire\Admin\Photobooth;
use App\Livewire\Admin\DamagedItems;

Route::redirect('/', '/login');

// Custom logout route that redirects directly to login
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    
    // User Dashboard & Items
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/items', Items::class)->name('items.index');
    
    // User Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/items', Items::class)->name('items.index'); // alias
        Route::get('/rentals', Rentals::class)->name('rentals.index');
        Route::get('/rentals/create', CreateBulkRental::class)->name('rentals.create');
        Route::get('/rentals/create/{itemId}', CreateRental::class)->name('rentals.create.single');
        Route::get('/financial', Financial::class)->name('financial');
        Route::get('/reports', Reports::class)->name('reports');
        Route::get('/analytics', Analytics::class)->name('analytics');
        Route::get('/queues', PhotoboothQueues::class)->name('queues');
    });
    
    // Admin Routes
    Route::middleware(['can:is-admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/items', AdminItems::class)->name('items');
        Route::get('/rentals', AdminRentals::class)->name('rentals');
        Route::get('/reports', AdminReports::class)->name('reports');
        Route::get('/analytics', AdminAnalytics::class)->name('analytics');
        Route::get('/financial', AdminFinancial::class)->name('financial');
        Route::get('/damaged-items', DamagedItems::class)->name('damaged-items');
        Route::get('/photobooth', Photobooth::class)->name('photobooth');
    });
    
    // Profile Routes
    Route::view('profile', 'profile')->name('profile');
});

require __DIR__.'/auth.php';
require __DIR__.'/settings.php';