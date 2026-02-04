<?php

namespace App\Livewire\Rentals;

use App\Models\Item;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

class CreateRental extends Component
{
    public $item;
    public $start_date = '';
    public $end_date = '';
    public $purpose = '';
    public $accept_terms = false;
    public $isSubmitting = false;

    protected $rules = [
        'start_date' => ['required', 'date', 'after_or_equal:today'],
        'end_date' => ['required', 'date', 'after:start_date'],
        'purpose' => ['nullable', 'string', 'max:500'],
        'accept_terms' => ['accepted'],
    ];

    protected $messages = [
        'start_date.required' => 'Start date is required.',
        'start_date.after_or_equal' => 'Start date must be today or later.',
        'end_date.required' => 'End date is required.',
        'end_date.after' => 'End date must be after start date.',
        'accept_terms.accepted' => 'You must accept the rental terms.',
    ];

    public function mount($item)
    {
        $this->item = Item::findOrFail($item);

        // Check if item is available
        if (!$this->item->isAvailable()) {
            session()->flash('error', 'This item is not currently available for rental.');
            return redirect()->route('user.items.index');
        }

        // Check if user is verified
        if (!Auth::user()->ktp_verified_at) {
            session()->flash('error', 'You must complete KTP verification before renting items.');
            return redirect()->route('profile.edit');
        }
    }

    public function calculateCost()
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        
        if ($start >= $end) {
            return 0;
        }

        $days = $start->diffInDays($end) + 1;
        return $days * $this->item->daily_rate;
    }

    public function getDurationInDays()
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        $start = Carbon::parse($this->start_date);
        $end = Carbon::parse($this->end_date);
        
        return $start->diffInDays($end) + 1;
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $validated = $this->validate();

            // Check item availability again
            if (!$this->item->isAvailable()) {
                throw new \Exception('This item is no longer available.');
            }

            // Create rental
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'item_id' => $this->item->id,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'purpose' => $validated['purpose'] ?? null,
                'total_price' => $this->calculateCost(),
                'status' => 'pending',
                'payment_status' => 'unpaid',
            ]);

            session()->flash('success', 'Rental request submitted successfully! Awaiting admin approval.');
            $this->isSubmitting = false;

            return redirect()->route('user.rentals.show', $rental->id);
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to create rental: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Rental creation error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'item_id' => $this->item->id,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.rentals.create-rental', [
            'item' => $this->item,
        ]);
    }
}
