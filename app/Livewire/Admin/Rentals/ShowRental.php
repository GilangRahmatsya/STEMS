<?php

namespace App\Livewire\Admin\Rentals;

use App\Models\Rental;
use Livewire\Component;

class ShowRental extends Component
{
    public $rental;
    public $newStatus = '';
    public $newPaymentStatus = '';
    public $isSubmitting = false;

    public function mount(Rental $rental)
    {
        $this->rental = $rental->load('user', 'item', 'item.category');
        $this->newStatus = $rental->status;
        $this->newPaymentStatus = $rental->payment_status;
    }

    public function updateStatus()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'newStatus' => ['required', 'in:pending,approved,picked_up,returned,rejected'],
            ]);

            $this->rental->update([
                'status' => $this->newStatus,
            ]);

            session()->flash('success', 'Rental status updated successfully!');
            $this->isSubmitting = false;

            $this->mount($this->rental);
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update status: ' . $e->getMessage());
        }
    }

    public function updatePaymentStatus()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'newPaymentStatus' => ['required', 'in:pending,paid,refunded'],
            ]);

            $this->rental->update([
                'payment_status' => $this->newPaymentStatus,
            ]);

            session()->flash('success', 'Payment status updated successfully!');
            $this->isSubmitting = false;

            $this->mount($this->rental);
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update payment status: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.rentals.show-rental', [
            'rental' => $this->rental,
        ]);
    }
}
