<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $password = '';
    public $password_confirmation = '';
    public $accept_terms = false;
    public $showPassword = false;
    public $showPasswordConfirm = false;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'unique:users,email'],
        'phone' => ['nullable', 'string', 'max:20'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'password_confirmation' => ['required'],
        'accept_terms' => ['accepted'],
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email address is already registered.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'password.confirmed' => 'Passwords do not match.',
        'accept_terms.accepted' => 'You must accept the terms and conditions.',
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
        $validated = $this->validate();

        try {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password' => Hash::make($validated['password']),
                'email_verified_at' => null,
            ]);

            session()->flash('message', 'Account created successfully! Please log in with your credentials.');

            return redirect()->route('login');
        } catch (\Exception $e) {
            $this->addError('email', 'Failed to create account. Please try again.');
            \Illuminate\Support\Facades\Log::error('Registration error', [
                'error' => $e->getMessage(),
                'email' => $validated['email'],
            ]);
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
        return view('livewire.auth.register')->layout('layouts.guest');
    }
}
