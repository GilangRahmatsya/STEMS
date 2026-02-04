<?php

namespace App\Livewire;

use App\Models\FinancialRecord;
use Livewire\Component;
use Livewire\WithPagination;

class Financial extends Component
{
    use WithPagination;

    public $type = 'all';
    public $category = 'all';
    public $search = '';

    protected $queryString = [
        'type' => ['except' => 'all'],
        'category' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    public function updatedType()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getRecordsProperty()
    {
        $query = FinancialRecord::query()
            ->when($this->type !== 'all', fn($q) => $q->where('type', $this->type))
            ->when($this->category !== 'all', fn($q) => $q->where('category', $this->category))
            ->when($this->search, fn($q) => $q->where('description', 'like', '%' . $this->search . '%'))
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc');

        return $query->paginate(15);
    }

    public function getTotalIncomeProperty()
    {
        return FinancialRecord::where('type', 'income')->sum('amount');
    }

    public function getTotalExpenseProperty()
    {
        return FinancialRecord::where('type', 'expense')->sum('amount');
    }

    public function getNetIncomeProperty()
    {
        return $this->totalIncome - $this->totalExpense;
    }

    public function getCategoriesProperty()
    {
        return FinancialRecord::select('category')->distinct()->get()->pluck('category');
    }

    public function render()
    {
        return view('livewire.financial', [
            'records' => $this->records,
            'totalIncome' => $this->totalIncome,
            'totalExpense' => $this->totalExpense,
            'netIncome' => $this->netIncome,
            'categories' => $this->categories,
        ])->layout('layouts.app');
    }
}