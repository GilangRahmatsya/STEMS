<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Rental;
use Carbon\Carbon;

class CreateBulkRental extends Component
{
    public $start_date;
    public $end_date;
    public $notes = '';

    // Borrower credentials
    public $borrower_name;
    public $borrower_birth_date;
    public $purpose;
    public $ktp_notes;

    // Selected items with quantities
    public $selectedItems = [];
    public $itemQuantities = [];

    public function updatedStartDate()
    {
        $this->calculateTotal();
    }

    public function updatedEndDate()
    {
        $this->calculateTotal();
    }

    public function updatedSelectedItems()
    {
        $this->calculateTotal();
    }

    public function updatedItemQuantities()
    {
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        // This is already handled by the getTotalPriceProperty method
        // but we can trigger reactivity by calling it
        $this->getTotalPriceProperty();
    }

    public function getCanSubmitProperty()
    {
        return
            count($this->selectedItems) > 0 &&
            $this->start_date &&
            $this->end_date &&
            $this->borrower_name &&
            $this->borrower_birth_date &&
            $this->purpose;
    }

    public function addItem($itemId)
    {
        if (!in_array($itemId, $this->selectedItems)) {
            $this->selectedItems[] = $itemId;
            $this->itemQuantities[$itemId] = 1; // Default quantity
        }
    }

    public function removeItem($itemId)
    {
        $index = array_search($itemId, $this->selectedItems);
        if ($index !== false) {
            unset($this->selectedItems[$index]);
            unset($this->itemQuantities[$itemId]);
            $this->selectedItems = array_values($this->selectedItems); // Reindex
        }
    }

    public function updateQuantity($itemId, $quantity)
    {
        if ($quantity > 0) {
            $this->itemQuantities[$itemId] = $quantity;
        }
    }

    public function submit()
    {
        logger('SUBMIT BULK RENT START', [
            'canSubmit' => $this->canSubmit,
            'selectedItems' => $this->selectedItems,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'borrower_name' => $this->borrower_name,
            'borrower_birth_date' => $this->borrower_birth_date,
            'purpose' => $this->purpose,
            'user_id' => auth()->id()
        ]);

        $this->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string|max:500',
            'borrower_name' => 'required|string|max:255',
            'borrower_birth_date' => 'required|date',
            'purpose' => 'required|string|max:1000',
            'ktp_notes' => 'nullable|string|max:1000',
            'selectedItems' => 'required|array|min:1',
        ]);

        logger('SUBMIT BULK RENT VALIDATION PASSED');

        if (empty($this->selectedItems)) {
            $this->addError('selectedItems', 'Please select at least one item to rent.');
            return;
        }

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $days = $start->diffInDays($end) + 1;

        $createdRentals = [];

        foreach ($this->selectedItems as $itemId) {
            $item = Item::findOrFail($itemId);
            $quantity = $this->itemQuantities[$itemId] ?? 1;

            // Check if enough quantity is available
            if ($quantity > $item->quantity) {
                $this->addError('selectedItems', "Not enough {$item->name} available. Only {$item->quantity} left.");
                return;
            }

            // Create rental for each item
            for ($i = 0; $i < $quantity; $i++) {
                $rental = Rental::create([
                    'user_id' => auth()->id(),
                    'item_id' => $itemId,
                    'start_date' => $this->start_date,
                    'end_date' => $this->end_date,
                    'total_price' => $days * $item->rent_price,
                    'status' => 'pending',
                    'notes' => $this->notes,
                    'borrower_name' => $this->borrower_name,
                    'borrower_birth_date' => $this->borrower_birth_date,
                    'purpose' => $this->purpose,
                    'ktp_notes' => $this->ktp_notes,
                    'payment_status' => 'pending',
                    'pickup_status' => 'pending',
                    'return_status' => 'pending',
                    'ktp_status' => 'pending',
                ]);

                $createdRentals[] = $rental;
            }
        }

        // Reset form
        $this->reset(['start_date', 'end_date', 'notes', 'borrower_name', 'borrower_birth_date', 'purpose', 'ktp_notes', 'selectedItems', 'itemQuantities']);

        session()->flash('message', 'Rental request submitted successfully for ' . count($createdRentals) . ' item(s).');

        return redirect()->route('user.rentals.index');
    }

    public function getAvailableItemsProperty()
    {
        return Item::where('condition', '!=', 'Bad')
            ->where('status', 'Ready')
            ->where('quantity', '>', 0)
            ->with('category')
            ->get();
    }

    public function getSelectedItemsDataProperty()
    {
        if (empty($this->selectedItems)) {
            return collect();
        }

        return Item::whereIn('id', $this->selectedItems)->with('category')->get();
    }

    public function getTotalPriceProperty()
    {
        if (!$this->start_date || !$this->end_date) return 0;

        $days = \Carbon\Carbon::parse($this->start_date)
            ->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1;

        $total = 0;

        foreach ($this->selectedItems as $itemId) {
            $item = \App\Models\Item::find($itemId);
            $qty = $this->itemQuantities[$itemId] ?? 1;

            if ($item) {
                $total += $item->rent_price * $qty * $days;
            }
        }

        return $total;
    }

    public function render()
    {
        return view('livewire.create-bulk-rental', [
            'availableItems' => $this->availableItems,
            'selectedItemsData' => $this->selectedItemsData,
            'totalPrice' => $this->totalPrice,
            'canSubmit' => $this->canSubmit,
        ])->layout('layouts.app');
    }
}