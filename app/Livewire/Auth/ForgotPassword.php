<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email = '';
    public $isDarkMode = false;
    public $status = '';

    protected $rules = [
        'email' => ['required', 'email'],
    ];

    protected $messages = [
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
    ];

    public function mount()
    {
        // Redirect if already authenticated
        if (auth()->check()) {
            return redirect()->route('user.dashboard');
        }
    }

    public function submit()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email]
        );

        if ($status === Password::RESET_LINK_SENT) {
            $this->status = trans($status);
            $this->email = '';
            session()->flash('message', 'Password reset link sent to your email!');
        } else {
            $this->addError('email', trans($status));
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('layouts.guest');
    }
}
