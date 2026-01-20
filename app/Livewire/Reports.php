<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Rental;
use App\Models\Item;
use Carbon\Carbon;

class Reports extends Component
{
    public $startDate;
    public $endDate;
    public $lazy = true;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        // Get all rentals (not filtered by user) - read-only view
        $rentals = Rental::whereBetween('created_at', [$this->startDate, $this->endDate])
            ->with(['user:id,name,email', 'item:id,name,category_id'])
            ->with(['item.category:id,name'])
            ->limit(100)
            ->get();

        $totalRevenue = $rentals->where('status', 'approved')->sum('total_price');
        $totalRentals = $rentals->count();
        $approvedRentals = $rentals->where('status', 'approved')->count();
        $pendingRentals = $rentals->where('status', 'pending')->count();

        $popularItems = Item::withCount(['rentals' => function ($query) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate])
                  ->where('status', 'approved');
        }])->orderBy('rentals_count', 'desc')->take(5)->get();

        return view('livewire.reports', [
            'rentals' => $rentals,
            'totalRevenue' => $totalRevenue,
            'totalRentals' => $totalRentals,
            'approvedRentals' => $approvedRentals,
            'pendingRentals' => $pendingRentals,
            'popularItems' => $popularItems
        ])->layout('layouts.app');
    }
}