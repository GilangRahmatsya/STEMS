<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $isDarkMode = false;
    public $userStats = [];
    public $recentRentals = [];
    public $availableItems = [];
    public $rentalTrends = [];
    public $isAdmin = false;

    public function mount()
    {
        $this->isAdmin = Auth::user()->role === 'admin';
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $user = Auth::user();
        $this->isAdmin = $user->role === 'admin';

        if ($this->isAdmin) {
            $this->loadAdminStats();
        } else {
            $this->loadUserStats();
        }
    }

    private function loadUserStats()
    {
        $user = Auth::user();

        // User statistics
        $this->userStats = [
            'totalRentals' => $user->rentals()->count(),
            'activeRentals' => $user->rentals()->whereIn('status', ['pending', 'approved', 'picked_up'])->count(),
            'completedRentals' => $user->rentals()->where('status', 'returned')->count(),
            'totalSpent' => $user->rentals()->where('payment_status', 'paid')->sum('total_cost') ?? 0,
        ];

        // Recent rentals
        $this->recentRentals = $user->rentals()
            ->with('item')
            ->orderByDesc('created_at')
            ->take(5)
            ->get()
            ->map(fn($rental) => [
                'id' => $rental->id,
                'itemName' => $rental->item->name,
                'status' => $rental->status,
                'startDate' => $rental->start_date->format('M d, Y'),
                'endDate' => $rental->end_date->format('M d, Y'),
                'totalCost' => $rental->total_cost,
            ])
            ->toArray();

        // Available items
        $this->availableItems = Item::where('status', 'Ready')
            ->where('condition', '!=', 'Bad')
            ->where('quantity', '>', 0)
            ->take(6)
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'category' => $item->category ?? 'Uncategorized',
                'rent_price' => $item->rent_price,
                'quantity' => $item->quantity,
                'image' => $item->image,
            ])
            ->toArray();

        // Rental trends (last 30 days)
        $this->rentalTrends = $this->generateRentalTrends();
    }

    private function loadAdminStats()
    {
        // Admin statistics
        $this->userStats = [
            'totalRentals' => Rental::count(),
            'activeRentals' => Rental::whereIn('status', ['pending', 'approved', 'picked_up'])->count(),
            'completedRentals' => Rental::where('status', 'returned')->count(),
            'totalRevenue' => Rental::where('payment_status', 'paid')->sum('total_cost') ?? 0,
            'totalUsers' => User::where('role', 'user')->count(),
            'totalEquipment' => Item::count(),
        ];

        // Recent rentals (all users)
        $this->recentRentals = Rental::with(['item', 'user'])
            ->orderByDesc('created_at')
            ->take(5)
            ->get()
            ->map(fn($rental) => [
                'id' => $rental->id,
                'itemName' => $rental->item->name,
                'userName' => $rental->user->name,
                'status' => $rental->status,
                'startDate' => $rental->start_date->format('M d, Y'),
                'endDate' => $rental->end_date->format('M d, Y'),
                'totalCost' => $rental->total_cost,
            ])
            ->toArray();

        // Popular items (rented most)
        $this->availableItems = Item::withCount('rentals')
            ->orderByDesc('rentals_count')
            ->take(6)
            ->get()
            ->map(fn($item) => [
                'id' => $item->id,
                'name' => $item->name,
                'category' => $item->category ?? 'Uncategorized',
                'rent_price' => $item->rent_price,
                'quantity' => $item->quantity,
                'rentals_count' => $item->rentals_count,
                 'image' => $item->image,
            ])
            ->toArray();

        // Admin rental trends
        $this->rentalTrends = $this->generateAdminRentalTrends();
    }

    private function generateRentalTrends()
    {
        $user = Auth::user();
        $trends = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('M d');
            $count = $user->rentals()
                ->whereDate('created_at', Carbon::now()->subDays($i))
                ->count();

            $trends[] = [
                'date' => $date,
                'count' => $count,
            ];
        }

        return $trends;
    }

    private function generateAdminRentalTrends()
    {
        $trends = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('M d');
            $count = Rental::whereDate('created_at', Carbon::now()->subDays($i))
                ->count();

            $trends[] = [
                'date' => $date,
                'count' => $count,
            ];
        }

        return $trends;
    }

    public function getRentalStatusBadgeClass($status)
    {
        return match($status) {
            'pending' => 'bg-warning-100 dark:bg-warning-900/20 text-warning-700 dark:text-warning-300',
            'approved' => 'bg-primary-100 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300',
            'picked_up' => 'bg-secondary-100 dark:bg-secondary-900/20 text-secondary-700 dark:text-secondary-300',
            'returned' => 'bg-success-100 dark:bg-success-900/20 text-success-700 dark:text-success-300',
            'rejected' => 'bg-danger-100 dark:bg-danger-900/20 text-danger-700 dark:text-danger-300',
            default => 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300',
        };
    }

    public function getRentalStatusLabel($status)
    {
        return match($status) {
            'pending' => 'Pending',
            'approved' => 'Approved',
            'picked_up' => 'Picked Up',
            'returned' => 'Returned',
            'rejected' => 'Rejected',
            default => ucfirst($status),
        };
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'userStats' => $this->userStats,
            'recentRentals' => $this->recentRentals,
            'availableItems' => $this->availableItems,
            'rentalTrends' => $this->rentalTrends,
        ]);
    }
}