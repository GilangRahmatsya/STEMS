<?php

namespace App\Livewire\Admin;

use App\Models\FinancialRecord;
use Livewire\Component;
use Livewire\WithPagination;

class Financial extends Component
{
    use WithPagination;

    public $type = 'all';
    public $category = 'all';
    public $search = '';
    public $showCreateModal = false;
    public $editingRecord = null;

    // Form fields
    public $recordType = 'income';
    public $recordCategory = '';
    public $description = '';
    public $amount = '';
    public $recordDate = '';

    protected $rules = [
        'recordType' => 'required|in:income,expense',
        'recordCategory' => 'required|string|max:255',
        'description' => 'required|string|max:500',
        'amount' => 'required|numeric|min:0',
        'recordDate' => 'required|date',
    ];

    public function mount()
    {
        $this->recordDate = now()->format('Y-m-d');
    }

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

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function editRecord($recordId)
    {
        $record = FinancialRecord::find($recordId);
        if ($record) {
            $this->editingRecord = $record;
            $this->recordType = $record->type;
            $this->recordCategory = $record->category;
            $this->description = $record->description;
            $this->amount = $record->amount;
            $this->recordDate = $record->date->format('Y-m-d');
            $this->showCreateModal = true;
        }
    }

    public function saveRecord()
    {
        $this->validate();

        $data = [
            'type' => $this->recordType,
            'category' => $this->recordCategory,
            'description' => $this->description,
            'amount' => $this->amount,
            'date' => $this->recordDate,
        ];

        if ($this->editingRecord) {
            $this->editingRecord->update($data);
            session()->flash('message', 'Financial record updated successfully.');
        } else {
            FinancialRecord::create($data);
            session()->flash('message', 'Financial record created successfully.');
        }

        $this->closeModal();
    }

    public function deleteRecord($recordId)
    {
        $record = FinancialRecord::find($recordId);
        if ($record) {
            // Additional check for records older than 30 days
            if ($record->created_at->diffInDays(now()) > 30) {
                session()->flash('error', 'Cannot delete financial records older than 30 days for audit purposes.');
                return;
            }

            $record->delete();
            session()->flash('message', 'Financial record deleted successfully.');
        }
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->editingRecord = null;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->recordType = 'income';
        $this->recordCategory = '';
        $this->description = '';
        $this->amount = '';
        $this->recordDate = now()->format('Y-m-d');
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
        return view('livewire.admin.financial', [
            'records' => $this->records,
            'totalIncome' => $this->totalIncome,
            'totalExpense' => $this->totalExpense,
            'netIncome' => $this->netIncome,
            'categories' => $this->categories,
        ])->layout('layouts.app');
    }
}