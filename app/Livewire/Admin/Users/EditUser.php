<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $role = '';
    public $isSubmitting = false;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->role = $user->role;
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $this->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'unique:users,email,' . $this->user->id],
                'phone' => ['nullable', 'string', 'max:20'],
                'address' => ['nullable', 'string', 'max:500'],
                'role' => ['required', 'in:user,admin'],
            ]);

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone ?? null,
                'address' => $this->address ?? null,
                'role' => $this->role,
            ]);

            session()->flash('success', 'User updated successfully!');
            $this->isSubmitting = false;

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update user: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.users.edit-user');
    }
}
