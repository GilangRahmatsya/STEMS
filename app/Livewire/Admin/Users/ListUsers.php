<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $search = '';
    public $role = '';
    public $ktpVerified = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 15;

    protected $queryString = ['search', 'role', 'ktpVerified'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function grantAdmin($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->update(['role' => 'admin']);
            session()->flash('success', "Admin permission granted to {$user->name}");
        } catch (\Exception $e) {
            session()->flash('error', "Failed to grant admin permission: {$e->getMessage()}");
        }
    }

    public function revokeAdmin($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->update(['role' => 'user']);
            session()->flash('success', "Admin permission revoked from {$user->name}");
        } catch (\Exception $e) {
            session()->flash('error', "Failed to revoke admin permission: {$e->getMessage()}");
        }
    }

    public function render()
    {
        $query = User::query()
            ->when($this->search, fn($query) => $query->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")
                ->orWhere('phone', 'like', "%{$this->search}%"))
            ->when($this->role, fn($query) => $query->where('role', $this->role))
            ->when($this->ktpVerified === 'verified', fn($query) => $query->whereNotNull('ktp_verified_at'))
            ->when($this->ktpVerified === 'pending', fn($query) => $query->whereNull('ktp_verified_at'));

        $users = $query
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

        $stats = [
            'total_users' => User::count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_regular_users' => User::where('role', 'user')->count(),
            'ktp_verified' => User::whereNotNull('ktp_verified_at')->count(),
        ];

        return view('livewire.admin.users.list-users', [
            'users' => $users,
            'stats' => $stats,
        ]);
    }
}
