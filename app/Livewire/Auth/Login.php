<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;
    public $showPassword = false;
    public $isDarkMode = false;

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'string', 'min:6'],
    ];

    protected $messages = [
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 6 characters.',
    ];

    public function mount()
    {
        // Redirect if already authenticated
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        }
    }

    public function submit()
    {
        $validated = $this->validate();

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $validated['remember'] ?? false)) {
            $this->addError('email', 'These credentials do not match our records.');
            return;
        }

        session()->regenerate();
        session()->flash('message', 'Welcome back! You have been successfully logged in.');

        return redirect()->intended(route('user.dashboard'));
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.guest');
    }
}
