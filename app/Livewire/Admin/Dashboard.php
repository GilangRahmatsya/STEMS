<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Item;
use App\Models\Rental;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $lazy = true; // Enable lazy loading for better performance
    public function render()
    {
        $cacheKey = 'admin_dashboard_stats';
        
        $stats = Cache::remember($cacheKey, 600, function () { // Cache 10 menit
            $totalIncome = \App\Models\FinancialRecord::where('type', 'income')->sum('amount') ?? 0;
            $totalExpense = \App\Models\FinancialRecord::where('type', 'expense')->sum('amount') ?? 0;
            
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
                'cash_on_hand' => $totalIncome - $totalExpense, // Cash tersisa setelah semua pengeluaran
                'assets_from_financial' => $totalIncome - $totalExpense + (Item::sum('buy_price') ?? 0), // Total aset dari financial + nilai barang
            ];
        });

        // Kondisi items untuk pie chart - cache juga
        $condition_stats = Cache::remember('admin_condition_stats', 600, function () {
            return Item::select('condition', DB::raw('count(*) as total'))
                ->groupBy('condition')
                ->get();
        });

        // Recent rentals (5 terakhir) - cache 5 menit
        $recent_rentals = Cache::remember('admin_recent_rentals', 300, function () {
            return Rental::with(['user', 'item'])
                ->latest()
                ->take(5)
                ->get();
        });

        // Pending rentals yang perlu approval - cache 2 menit
        $pending_rentals = Cache::remember('admin_pending_rentals', 120, function () {
            return Rental::with(['user', 'item'])
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();
        });

        // Top rented items - cache 10 menit
        $top_items = Cache::remember('admin_top_items', 600, function () {
            return Item::withCount(['rentals' => function($query) {
                    $query->where('status', 'approved');
                }])
                ->orderBy('rentals_count', 'desc')
                ->take(5)
                ->get();
        });

        // Asset breakdown by category - cache 10 menit
        $asset_breakdown = Cache::remember('admin_asset_breakdown', 600, function () {
            return Item::select('category_id', \DB::raw('COUNT(*) as item_count'), \DB::raw('SUM(buy_price) as total_value'))
                ->with('category:id,name')
                ->groupBy('category_id')
                ->orderBy('total_value', 'desc')
                ->get();
        });

        // Asset breakdown by status - cache 10 menit
        $asset_by_status = Cache::remember('admin_asset_by_status', 600, function () {
            return Item::select('status', \DB::raw('COUNT(*) as item_count'), \DB::raw('SUM(buy_price) as total_value'))
                ->groupBy('status')
                ->orderBy('total_value', 'desc')
                ->get();
        });

        // Financial breakdown untuk chart - cache 10 menit
        $financial_breakdown = Cache::remember('admin_financial_breakdown', 600, function () {
            return [
                'income' => \App\Models\FinancialRecord::where('type', 'income')
                    ->selectRaw('DATE_TRUNC(\'month\', date) as month, SUM(amount) as total')
                    ->groupBy('month')
                    ->orderBy('month', 'desc')
                    ->take(12)
                    ->get(),
                'expense' => \App\Models\FinancialRecord::where('type', 'expense')
                    ->selectRaw('DATE_TRUNC(\'month\', date) as month, SUM(amount) as total')
                    ->groupBy('month')
                    ->orderBy('month', 'desc')
                    ->take(12)
                    ->get(),
            ];
        });

        return view('livewire.admin.dashboard', compact(
            'stats',
            'condition_stats',
            'recent_rentals',
            'pending_rentals',
            'top_items',
            'financial_breakdown',
            'asset_breakdown',
            'asset_by_status'
        ));
    }

    public function mount()
    {
        // Dispatch event untuk update chart saat komponen dimuat
        $this->dispatch('financialDataUpdated');
    }

    public function refreshStats()
    {
        // Clear cache dan refresh data
        Cache::forget('admin_dashboard_stats');
        Cache::forget('admin_condition_stats');
        Cache::forget('admin_recent_rentals');
        Cache::forget('admin_pending_rentals');
        Cache::forget('admin_top_items');
        Cache::forget('admin_financial_breakdown');
        Cache::forget('admin_asset_breakdown');
        Cache::forget('admin_asset_by_status');

        // Dispatch event untuk update chart
        $this->dispatch('financialDataUpdated');
    }
}