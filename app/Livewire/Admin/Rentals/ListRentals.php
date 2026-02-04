<?php

namespace App\Livewire\Admin\Rentals;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class ListRentals extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $paymentStatus = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;

    protected $queryString = ['search', 'status', 'paymentStatus'];

    public function updatingSearch()
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

    public function render()
    {
        $rentals = Rental::query()
            ->with(['user', 'item'])
            ->when($this->search, fn($query) => $query->whereHas('user', fn($q) => 
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%")
            )->orWhereHas('item', fn($q) => 
                $q->where('name', 'like', "%{$this->search}%")
            ))
            ->when($this->status, fn($query) => $query->where('status', $this->status))
            ->when($this->paymentStatus, fn($query) => $query->where('payment_status', $this->paymentStatus))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.rentals.list-rentals', [
            'rentals' => $rentals,
        ]);
    }
}
