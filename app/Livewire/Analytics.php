<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;

class Analytics extends Component
{
    public function render()
    {
        // Monthly revenue for the last 12 months
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Rental::where('status', 'approved')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total_price');
            $monthlyRevenue[] = [
                'month' => $date->format('M Y'),
                'revenue' => $revenue
            ];
        }

        // Item utilization
        $itemUtilization = Item::withCount(['rentals' => function ($query) {
            $query->where('status', 'approved')
                  ->where('created_at', '>=', Carbon::now()->subMonths(6));
        }])->get()->map(function ($item) {
            return [
                'name' => $item->name,
                'rentals' => $item->rentals_count,
                'utilization' => $item->rentals_count > 0 ? min(100, ($item->rentals_count / 30) * 100) : 0
            ];
        })->sortByDesc('rentals')->take(10);

        // User activity
        $activeUsers = User::whereHas('rentals', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subMonths(6));
        })->withCount(['rentals' => function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subMonths(6));
        }])->get();

        $stats = [
            'total_items' => Item::count(),
            'total_users' => User::count(),
            'total_rentals' => Rental::count(),
            'active_rentals' => Rental::where('status', 'approved')->where('end_date', '>=', Carbon::today())->count(),
            'total_revenue' => Rental::where('status', 'approved')->sum('total_price'),
            'avg_rental_duration' => Rental::where('status', 'approved')->selectRaw('AVG((end_date - start_date) + 1) as avg_days')->first()->avg_days ?? 0
        ];

        return view('livewire.analytics', [
            'monthlyRevenue' => $monthlyRevenue,
            'itemUtilization' => $itemUtilization,
            'activeUsers' => $activeUsers,
            'stats' => $stats
        ])->layout('layouts.app');
    }
}