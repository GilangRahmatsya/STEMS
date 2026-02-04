<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Rental;
use Carbon\Carbon;

class CreateRental extends Component
{
    public $item_id;
    public $start_date;
    public $end_date;
    public $notes = '';

    // Borrower credentials
    public $borrower_name;
    public $borrower_birth_date;
    public $purpose;

    // KTP notes
    public $ktp_notes;

    public function getTotalDaysProperty()
    {
        if (!$this->start_date || !$this->end_date) return 0;

        return \Carbon\Carbon::parse($this->start_date)
            ->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1;
    }

    public function getTotalPriceProperty()
    {
        if (!$this->item_id || !$this->start_date || !$this->end_date) return 0;

        $item = Item::find($this->item_id);
        if (!$item) return 0;

        return $this->totalDays * $item->rent_price;
    }

    public function getCanSubmitProperty()
    {
        return
            $this->start_date &&
            $this->end_date &&
            $this->borrower_name &&
            $this->borrower_birth_date &&
            $this->purpose;
    }

    public function submit()
    {
        logger('SUBMIT RENT START', [
            'canSubmit' => $this->canSubmit,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'borrower_name' => $this->borrower_name,
            'borrower_birth_date' => $this->borrower_birth_date,
            'purpose' => $this->purpose,
            'user_id' => auth()->id()
        ]);

        // Temporarily remove validation for debugging
        // $this->validate([
        //     'start_date' => 'required|date',
        //     'end_date' => 'required|date|after:start_date',
        //     'notes' => 'nullable|string|max:500',
        //     'borrower_name' => 'required|string|max:255',
        //     'borrower_birth_date' => 'required|date',
        //     'purpose' => 'required|string|max:1000',
        //     'ktp_notes' => 'nullable|string|max:1000'
        // ]);

        logger('SUBMIT RENT VALIDATION PASSED');

        $item = Item::findOrFail($this->item_id);

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        $days = $start->diffInDays($end) + 1; // inclusive

        $totalPrice = $days * $item->rent_price;

        Rental::create([
            'user_id' => auth()->id(),
            'item_id' => $this->item_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $this->notes,
            'borrower_name' => $this->borrower_name,
            'borrower_birth_date' => $this->borrower_birth_date,
            'purpose' => $this->purpose,
            'ktp_notes' => $this->ktp_notes
        ]);

        session()->flash('message', 'Rental request submitted successfully!');

        return redirect()->route('user.rentals.index');
    }

    public function render()
    {
        $item = Item::findOrFail($this->item_id);

        return view('livewire.create-rental', [
            'item' => $item,
            'canSubmit' => $this->canSubmit,
        ]);
    }
}