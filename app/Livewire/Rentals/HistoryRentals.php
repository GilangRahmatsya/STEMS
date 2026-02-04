<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryRentals extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;

    protected $queryString = ['search', 'sortBy', 'sortDirection'];

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
            ->where('user_id', auth()->id())
            ->where('status', 'returned')
            ->when($this->search, fn($query) => 
                $query->whereHas('item', fn($q) => 
                    $q->where('name', 'like', "%{$this->search}%")
                )
                ->orWhere('id', 'like', "%{$this->search}%")
            )
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.rentals.history-rentals', [
            'rentals' => $rentals,
        ]);
    }
}
