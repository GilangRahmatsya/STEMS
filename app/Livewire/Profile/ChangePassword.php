<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';
    public $showCurrentPassword = false;
    public $showPassword = false;
    public $showPasswordConfirm = false;
    public $isSubmitting = false;

    protected $rules = [
        'current_password' => ['required', 'string'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required'],
    ];

    protected $messages = [
        'current_password.required' => 'Current password is required.',
        'password.required' => 'New password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
    ];

    public function submit()
    {
        $this->isSubmitting = true;

        try {
            $validated = $this->validate();

            $user = Auth::user();

            // Verify current password
            if (!Hash::check($validated['current_password'], $user->password)) {
                $this->addError('current_password', 'Current password is incorrect.');
                $this->isSubmitting = false;
                return;
            }

            // Update password
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            session()->flash('success', 'Password changed successfully!');
            $this->isSubmitting = false;

            // Reset form
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';

            return redirect()->route('profile.change-password');
        } catch (\Exception $e) {
            $this->isSubmitting = false;
            session()->flash('error', 'Failed to change password: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error('Password change error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);
        }
    }

    public function toggleCurrentPasswordVisibility()
    {
        $this->showCurrentPassword = !$this->showCurrentPassword;
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function togglePasswordConfirmVisibility()
    {
        $this->showPasswordConfirm = !$this->showPasswordConfirm;
    }

    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
