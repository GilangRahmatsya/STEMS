<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class ShowUser extends Component
{
    public $user;
    public $newRole = '';
    public $isSubmitting = false;

    public function mount(User $user)
    {
        $this->user = $user->load('rentals');
        $this->newRole = $user->role;
    }

    public function updateRole()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'newRole' => ['required', 'in:user,admin'],
            ]);

            $this->user->update([
                'role' => $this->newRole,
            ]);

            session()->flash('success', 'User role updated successfully!');
            $this->isSubmitting = false;

            $this->mount($this->user);
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update role: ' . $e->getMessage());
        }
    }

    public function verifyKtp()
    {
        try {
            $this->user->update([
                'ktp_verified_at' => now(),
            ]);

            session()->flash('success', 'KTP verified successfully!');
            $this->mount($this->user);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to verify KTP: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.users.show-user', [
            'user' => $this->user,
        ]);
    }
}
