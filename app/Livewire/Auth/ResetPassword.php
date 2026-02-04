<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Component;

class ResetPassword extends Component
{
    public $token = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $isDarkMode = false;
    public $showPassword = false;
    public $showPasswordConfirm = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required'],
    ];

    protected $messages = [
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
    ];

    public function mount($token = '')
    {
        // Redirect if already authenticated
        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }

        $this->token = $token;
    }

    public function submit()
    {
        $this->validate();

        $status = Password::reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            session()->flash('message', 'Password has been reset successfully!');
            return redirect()->route('login');
        } else {
            $this->addError('email', trans($status));
        }
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
        return view('livewire.auth.reset-password')->layout('layouts.guest');
    }
}
