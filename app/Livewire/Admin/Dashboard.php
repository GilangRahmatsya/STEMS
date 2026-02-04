<?php

namespace App\Livewire\Admin;

use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use App\Models\FinancialRecord;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $lazy = true; // Enable lazy loading for better performance
    public $stats = [
        'total_items' => 0,
        'ready_items' => 0,
        'on_rent' => 0,
        'need_maintenance' => 0,
        'total_assets' => 0,
        'total_income' => 0,
        'total_expenses' => 0,
        'net_profit' => 0,
        'cash_on_hand' => 0,
        'assets_from_financial' => 0,
    ];
    public $condition_stats = [];
    public $recent_rentals = [];
    public $pending_rentals = [];
    public $top_items = [];
    public $asset_breakdown = [];
    public $asset_by_status = [];
    public $financial_breakdown = [];

    public function mount()
    {
        // Load data during mount
        $this->loadDashboardData();
        // Dispatch event untuk update chart saat komponen dimuat
        $this->dispatch('financialDataUpdated');
    }

    public function loadDashboardData()
    {
        $stats = Cache::remember('admin_dashboard_stats', 600, function () {
            $totalIncome = FinancialRecord::where('type', 'income')->sum('amount') ?? 0;
            $totalExpense = FinancialRecord::where('type', 'expense')->sum('amount') ?? 0;
            
            return [
                'total_items' => Item::count(),
                'ready_items' => Item::where('status', 'Ready')->count(),
                'on_rent' => Rental::where('status', 'approved')
                    ->whereNull('returned_at')
                    ->count(),
                'need_maintenance' => Item::where('condition', 'Bad')->count(),
                'total_assets' => Item::sum('buy_price') ?? 0,
                'total_income' => $totalIncome,
                'total_expenses' => $totalExpense,
                'net_profit' => $totalIncome - $totalExpense,
                'cash_on_hand' => $totalIncome - $totalExpense,
                'assets_from_financial' => $totalIncome - $totalExpense + (Item::sum('buy_price') ?? 0),
            ];
        });

        $this->stats = array_merge($this->stats, $stats ?? []);
        
        $this->condition_stats = Cache::remember('admin_condition_stats', 600, function () {
            return Item::select('condition', DB::raw('count(*) as total'))
                ->groupBy('condition')
                ->get();
        });

        $this->recent_rentals = Cache::remember('admin_recent_rentals', 300, function () {
            return Rental::with(['user', 'item'])
                ->latest()
                ->take(5)
                ->get();
        });

        $this->pending_rentals = Cache::remember('admin_pending_rentals', 120, function () {
            return Rental::with(['user', 'item'])
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();
        });

        $this->top_items = Cache::remember('admin_top_items', 600, function () {
            return Item::withCount(['rentals' => function($query) {
                    $query->where('status', 'approved');
                }])
                ->orderBy('rentals_count', 'desc')
                ->take(5)
                ->get();
        });

        $this->asset_breakdown = Cache::remember('admin_asset_breakdown', 600, function () {
            return Item::select('category_id', DB::raw('COUNT(*) as item_count'), DB::raw('SUM(buy_price) as total_value'))
                ->with('category:id,name')
                ->groupBy('category_id')
                ->orderBy('total_value', 'desc')
                ->get();
        });

        $this->asset_by_status = Cache::remember('admin_asset_by_status', 600, function () {
            return Item::select('status', DB::raw('COUNT(*) as item_count'), DB::raw('SUM(buy_price) as total_value'))
                ->groupBy('status')
                ->orderBy('total_value', 'desc')
                ->get();
        });

        $this->financial_breakdown = Cache::remember('admin_financial_breakdown', 600, function () {
            return [
                'income' => FinancialRecord::where('type', 'income')
                    ->selectRaw('strftime(\'%Y-%m\', date) as month, SUM(amount) as total')
                    ->groupBy('month')
                    ->orderBy('month', 'desc')
                    ->take(12)
                    ->get(),
                'expense' => FinancialRecord::where('type', 'expense')
                    ->selectRaw('strftime(\'%Y-%m\', date) as month, SUM(amount) as total')
                    ->groupBy('month')
                    ->orderBy('month', 'desc')
                    ->take(12)
                    ->get(),
            ];
        });
    }

    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => $this->stats,
            'condition_stats' => $this->condition_stats,
            'recent_rentals' => $this->recent_rentals,
            'pending_rentals' => $this->pending_rentals,
            'top_items' => $this->top_items,
            'financial_breakdown' => $this->financial_breakdown,
            'asset_breakdown' => $this->asset_breakdown,
            'asset_by_status' => $this->asset_by_status,
        ]);
    }

    public function refreshStats()
    {
        // Clear cache and reload data
        Cache::forget('admin_dashboard_stats');
        Cache::forget('admin_condition_stats');
        Cache::forget('admin_recent_rentals');
        Cache::forget('admin_pending_rentals');
        Cache::forget('admin_top_items');
        Cache::forget('admin_financial_breakdown');
        Cache::forget('admin_asset_breakdown');
        Cache::forget('admin_asset_by_status');

        // Reload data
        $this->loadDashboardData();
        
        // Dispatch event untuk update chart
        $this->dispatch('financialDataUpdated');
    }
}