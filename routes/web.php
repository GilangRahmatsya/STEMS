<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard;
use App\Livewire\Items\ListItems;
use App\Livewire\Items\CreateItem;
use App\Livewire\Items\EditItem;
use App\Livewire\Items\ShowItem;
use App\Livewire\Rentals\ListRentals;
use App\Livewire\Rentals\CreateRental;
use App\Livewire\Rentals\ShowRental;
use App\Livewire\Rentals\HistoryRentals;
use App\Livewire\Items\FavoriteItems;
use App\Livewire\Analytics;
use App\Livewire\Financial;
use App\Livewire\Reports;
use App\Livewire\PhotoboothQueues;
use App\Livewire\Profile\EditProfile;
use App\Livewire\Profile\ChangePassword;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Items\ListItems as AdminListItems;
use App\Livewire\Admin\Items\CreateItem as AdminCreateItem;
use App\Livewire\Admin\Items\EditItem as AdminEditItem;
use App\Livewire\Admin\Rentals\ListRentals as AdminListRentals;
use App\Livewire\Admin\Rentals\ShowRental as AdminShowRental;
use App\Livewire\Admin\Users\ListUsers as AdminListUsers;
use App\Livewire\Admin\Users\ShowUser as AdminShowUser;
use App\Livewire\Admin\Users\EditUser as AdminEditUser;
use App\Livewire\Admin\Categories\ListCategories as AdminListCategories;
use App\Livewire\Admin\Categories\CreateCategory as AdminCreateCategory;
use App\Livewire\Admin\Categories\EditCategory as AdminEditCategory;
use App\Livewire\Admin\Analytics as AdminAnalytics;
use App\Livewire\Admin\Financial as AdminFinancial;
use App\Livewire\Admin\Reports as AdminReports;
use App\Livewire\Admin\DamagedItems as AdminDamagedItems;
use App\Livewire\Admin\Photobooth as AdminPhotobooth;

// Welcome/Home Route
Route::get('/', function () {
    return auth()->check() ? redirect()->route('user.dashboard') : redirect()->route('login');
});

// Guest Routes (Authentication)
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', Dashboard::class)->name('user.dashboard');

    // Items
    Route::get('/items', ListItems::class)->name('user.items.index');
    Route::get('/items/favorites', FavoriteItems::class)->name('user.items.favorites');
    Route::get('/items/create', CreateItem::class)->name('user.items.create');
    Route::get('/items/{item}', ShowItem::class)->name('user.items.show');
    Route::get('/items/{item}/edit', EditItem::class)->name('user.items.edit');
    Route::delete('/items/{item}', \App\Http\Controllers\ItemController::class . '@destroy')->name('user.items.destroy');

    // Rentals
    Route::get('/rentals', ListRentals::class)->name('user.rentals.index');
    Route::get('/rentals/history', HistoryRentals::class)->name('user.rentals.history');
    Route::get('/rentals/create/{item}', CreateRental::class)->name('user.rentals.create');
    Route::get('/rentals/{rental}', ShowRental::class)->name('user.rentals.show');
    Route::get('/cart', \App\Livewire\Cart\CartManager::class)->name('user.cart');
    Route::delete('/rentals/{rental}', \App\Http\Controllers\RentalController::class . '@cancel')->name('user.rentals.cancel');

    // Analytics, Financial, Reports, Photobooth
    Route::get('/analytics', Analytics::class)->name('user.analytics');
    Route::get('/financial', Financial::class)->name('user.financial');
    Route::get('/reports', Reports::class)->name('user.reports');
    Route::get('/photobooth-queue', PhotoboothQueues::class)->name('user.queues');

    // Profile
    Route::get('/profile', EditProfile::class)->name('profile.edit');
    Route::post('/profile/update', \App\Http\Controllers\ProfileController::class . '@update')->name('profile.update');
    Route::get('/profile/change-password', ChangePassword::class)->name('profile.change-password');

    // Logout
    Route::post('/logout', \App\Http\Controllers\AuthController::class . '@logout')->name('logout');
});

// Admin Routes
Route::middleware(['auth', 'can:is-admin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

    // Admin Items Management
    Route::get('/items', AdminListItems::class)->name('items.index');
    Route::get('/items/create', AdminCreateItem::class)->name('items.create');
    Route::get('/items/{item}/edit', AdminEditItem::class)->name('items.edit');
    Route::delete('/items/{item}', \App\Http\Controllers\Admin\ItemController::class . '@destroy')->name('items.destroy');

    // Admin Rentals Management
    Route::get('/rentals', AdminListRentals::class)->name('rentals.index');
    Route::get('/rentals/{rental}', AdminShowRental::class)->name('rentals.show');

    // Admin Analytics, Financial, Reports, Photobooth, Damaged Items
    Route::get('/analytics', AdminAnalytics::class)->name('analytics');
    Route::get('/financial', AdminFinancial::class)->name('financial');
    Route::get('/reports', AdminReports::class)->name('reports');
    Route::get('/damaged-items', AdminDamagedItems::class)->name('damaged-items');
    Route::get('/photobooth', AdminPhotobooth::class)->name('photobooth');

    // Admin Users Management
    Route::get('/users', AdminListUsers::class)->name('users.index');
    Route::get('/users/{user}', AdminShowUser::class)->name('users.show');
    Route::get('/users/{user}/edit', AdminEditUser::class)->name('users.edit');

    // Admin Categories
    Route::get('/categories', AdminListCategories::class)->name('categories.index');
    Route::get('/categories/create', AdminCreateCategory::class)->name('categories.create');
    Route::get('/categories/{category}/edit', AdminEditCategory::class)->name('categories.edit');
    Route::delete('/categories/{category}', \App\Http\Controllers\Admin\CategoryController::class . '@destroy')->name('categories.destroy');
});