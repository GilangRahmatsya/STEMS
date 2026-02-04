<?php

namespace App\Livewire\Rentals;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowRental extends Component
{
    public $rental;

    public function mount(Rental $rental)
    {
        // Check authorization
        if ($rental->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Load relationships with safety - item may have been deleted
        $this->rental = $rental->load(['item' => function ($query) {
            $query->select('id', 'name', 'description', 'rent_price', 'category_id', 'user_id');
        }, 'item.category', 'user']);
    }

    public function cancelRental()
    {
        // Check if rental can be cancelled
        if (!in_array($this->rental->status, ['pending', 'approved'])) {
            session()->flash('error', 'This rental cannot be cancelled.');
            return;
        }

        $this->rental->update([
            'status' => 'rejected',
        ]);

        session()->flash('success', 'Rental cancelled successfully.');
        $this->redirect(route('user.rentals.index'));
    }

    public function render()
    {
        return view('livewire.rentals.show-rental', [
            'rental' => $this->rental,
        ]);
    }
}
