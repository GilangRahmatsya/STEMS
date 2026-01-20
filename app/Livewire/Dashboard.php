<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public function render()
    {
        $user = Auth::user();
        $cacheKey = "dashboard_stats_{$user->id}";

        $stats = Cache::remember($cacheKey, 300, function () use ($user) { // Cache 5 menit
            // Optimized single query for user stats
            $userRentals = Rental::where('user_id', $user->id)->get();
            
            return [
                'available_items' => Item::where('status', 'Ready')->count(),
                'active_rentals' => $userRentals->where('status', 'approved')->whereNull('returned_at')->count(),
                'pending_rentals' => $userRentals->where('status', 'pending')->count(),
                'total_spent' => $userRentals->where('status', 'approved')->sum('total_price') ?? 0,
            ];
        });

        // Available items untuk dipinjam (limit 6, tanpa random untuk performa)
        $available_items = Item::with('category')
            ->where('status', 'Ready')
            ->where('condition', '!=', 'Bad')
            ->latest()
            ->take(6)
            ->get();

        // Recent rentals user
        $recent_rentals = Rental::with('item')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Active rentals yang perlu dikembalikan (limit 10 untuk performa)
        $active_rentals = Rental::with('item')
            ->where('user_id', $user->id)
            ->where('status', 'approved')
            ->whereNull('returned_at')
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.dashboard', compact(
            'stats',
            'available_items',
            'recent_rentals',
            'active_rentals'
        ));
    }
}