<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Rentals extends Component
{
    use WithPagination;

    public $perPage = 10;
    public function render()
    {
        return view('livewire.rentals', [
            'rentals' => auth()->user()->rentals()->with('item')->latest()->paginate($this->perPage)
        ]);
    }
}