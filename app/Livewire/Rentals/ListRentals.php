<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListRentals extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = ['search', 'status', 'sortBy', 'sortDirection'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
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
            default => ucfirst(str_replace('_', ' ', $status)),
        };
    }

    public function getPaymentStatusBadgeClass($status)
    {
        return match($status) {
            'pending' => 'bg-warning-100 dark:bg-warning-900/20 text-warning-700 dark:text-warning-300',
            'paid' => 'bg-success-100 dark:bg-success-900/20 text-success-700 dark:text-success-300',
            'refunded' => 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300',
            default => 'bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300',
        };
    }

    public function render()
    {
        $user = Auth::user();

        $rentals = $user->rentals()
            ->with(['item', 'item.category'])
            ->when($this->search, fn($query) => $query->whereHas('item', fn($q) => 
                $q->where('name', 'like', "%{$this->search}%")
            ))
            ->when($this->status, fn($query) => $query->where('status', $this->status))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $activeCount = $user->rentals()
            ->whereIn('status', ['pending', 'approved', 'picked_up'])
            ->count();

        $pendingCount = $user->rentals()
            ->where('status', 'pending')
            ->count();

        $completedCount = $user->rentals()
            ->where('status', 'returned')
            ->count();

        return view('livewire.rentals.list-rentals', [
            'rentals' => $rentals,
            'activeCount' => $activeCount,
            'pendingCount' => $pendingCount,
            'completedCount' => $completedCount,
        ]);
    }
}
