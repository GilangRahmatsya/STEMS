<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Rental;
use App\Models\FinancialRecord;

class Rentals extends Component
{
    public $statusFilter = 'all';
    public $perPage = 10;
    public $lazy = true; // Enable lazy loading

    public function updateStatus($rentalId, $status)
    {
        $rental = Rental::findOrFail($rentalId);

        // Additional validation for status changes
        if ($status === 'approved') {
            // Check if item is available
            if ($rental->item->status !== 'Ready') {
                session()->flash('error', 'Cannot approve rental: Item is not available.');
                return;
            }

            // Check if item has sufficient quantity
            $activeRentals = $rental->item->rentals()
                ->where('status', 'approved')
                ->whereNull('returned_at')
                ->count();

            if ($activeRentals >= $rental->item->quantity) {
                session()->flash('error', 'Cannot approve rental: Insufficient item quantity available.');
                return;
            }
        }

        $rental->update(['status' => $status]);

        // Auto-create financial record when rental is approved
        if ($status === 'approved') {
            FinancialRecord::create([
                'type' => 'income',
                'category' => 'rental',
                'description' => "Rental: {$rental->item->name} by {$rental->user->name}",
                'amount' => $rental->total_price,
                'date' => now()->toDateString(),
                'rental_id' => $rental->id,
            ]);
        }

        session()->flash('message', 'Rental status updated successfully!');
    }

    public function updatePaymentStatus($rentalId, $status)
    {
        $rental = Rental::findOrFail($rentalId);
        $rental->update(['payment_status' => $status]);
        session()->flash('message', 'Payment status updated successfully!');
    }

    public function updatePickupStatus($rentalId, $status)
    {
        $rental = Rental::findOrFail($rentalId);
        $rental->update(['pickup_status' => $status]);
        session()->flash('message', 'Pickup status updated successfully!');
    }

    public function updateReturnStatus($rentalId, $status)
    {
        $rental = Rental::findOrFail($rentalId);

        // Additional validation for return status
        if ($status === 'returned') {
            // Check if rental was actually approved first
            if ($rental->status !== 'approved') {
                session()->flash('error', 'Cannot mark as returned: Rental was not approved.');
                return;
            }

            // Set returned_at timestamp
            $rental->update(['returned_at' => now()]);
        }

        $rental->update(['return_status' => $status]);

        // If item is returned, update KTP status to returned
        if ($status === 'returned') {
            $rental->update(['ktp_status' => 'returned']);
        }

        session()->flash('message', 'Return status updated successfully!');
    }

    public function updateKtpStatus($rentalId, $status)
    {
        $rental = Rental::findOrFail($rentalId);
        $rental->update(['ktp_status' => $status]);
        session()->flash('message', 'KTP status updated successfully!');
    }

    public function render()
    {
        $query = Rental::with(['user', 'item']);

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        return view('livewire.admin.rentals', [
            'rentals' => $query->with(['user:id,name,email', 'item:id,name,category_id'])
                ->with(['item.category:id,name'])
                ->latest()
                ->paginate($this->perPage)
        ]);
    }
}