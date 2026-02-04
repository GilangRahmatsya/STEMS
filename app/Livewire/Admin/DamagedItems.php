<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Item;
use App\Models\FinancialRecord;

class DamagedItems extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $selectedItem = null;
    public $damage_description;
    public $repair_cost;
    public $showReportForm = false;

    protected $rules = [
        'damage_description' => 'required|string|max:1000',
        'repair_cost' => 'required|numeric|min:0',
    ];

    public function mount()
    {
        // Removed loadDamagedItems call
    }

    public function selectItem($itemId)
    {
        $this->selectedItem = Item::findOrFail($itemId);
        $this->showReportForm = true;
        $this->reset(['damage_description', 'repair_cost']);
    }

    public function reportDamage()
    {
        $this->validate();

        // Create financial record for the loss
        FinancialRecord::create([
            'type' => 'expense',
            'category' => 'Equipment Damage',
            'description' => "Damage to {$this->selectedItem->name}: {$this->damage_description}",
            'amount' => $this->repair_cost,
            'date' => now(),
        ]);

        // Update item condition to reflect it's being repaired or written off
        $this->selectedItem->update([
            'condition' => 'Bad', // Keep as Bad until repaired
        ]);

        $this->reset(['selectedItem', 'damage_description', 'repair_cost', 'showReportForm']);

        session()->flash('message', 'Damage reported and financial record created successfully.');
    }

    public function markRepaired($itemId)
    {
        $item = Item::findOrFail($itemId);
        $item->update(['condition' => 'Good']);

        session()->flash('message', 'Item marked as repaired.');
    }

    public function cancelReport()
    {
        $this->reset(['selectedItem', 'damage_description', 'repair_cost', 'showReportForm']);
    }

    public function render()
    {
        $totalDamageCost = FinancialRecord::where('type', 'expense')
            ->where('category', 'Equipment Damage')
            ->where('created_at', '>=', now()->startOfYear())
            ->sum('amount');

        $damagedItems = Item::where('condition', 'Bad')
            ->with('category')
            ->latest()
            ->paginate($this->perPage);

        $totalDamagedItems = Item::where('condition', 'Bad')->count();

        $underRepairCount = Item::where('condition', 'Bad')
            ->where('status', 'Under Repair')
            ->count();

        return view('livewire.admin.damaged-items', [
            'damagedItems' => $damagedItems,
            'totalDamagedItems' => $totalDamagedItems,
            'underRepairCount' => $underRepairCount,
            'totalDamageCost' => $totalDamageCost,
        ])->layout('layouts.app');
    }
}