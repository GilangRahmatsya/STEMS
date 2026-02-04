<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProfile extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $ktp_number = '';
    public $isSubmitting = false;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'phone' => ['nullable', 'string', 'max:20'],
        'address' => ['nullable', 'string', 'max:500'],
        'ktp_number' => ['nullable', 'string', 'unique:users,ktp_number'],
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'email.required' => 'Email is required.',
        'email.unique' => 'This email is already in use.',
        'ktp_number.unique' => 'This KTP number is already registered.',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->ktp_number = $user->ktp_number ?? '';
    }

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            // Allow email to remain unchanged
            $rules = $this->rules;
            $rules['email'] = ['required', 'email', 'unique:users,email,' . Auth::id()];
            
            // Allow KTP to remain unchanged
            if ($this->ktp_number) {
                $rules['ktp_number'] = ['nullable', 'string', 'unique:users,ktp_number,' . Auth::id()];
            }

            $this->validate($rules);

            $user = Auth::user();
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone ?? null,
                'address' => $this->address ?? null,
                'ktp_number' => $this->ktp_number ?? null,
            ]);

            session()->flash('success', 'Profile updated successfully!');
            $this->isSubmitting = false;

            return redirect()->route('profile.edit');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to update profile: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Profile update error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}
