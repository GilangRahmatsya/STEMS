<?php

namespace App\Livewire;

use Livewire\Component;

class ThemeToggle extends Component
{
    public $isDarkMode = false;

    public function mount()
    {
        // This will be handled by JavaScript/Alpine
    }

    public function toggleTheme()
    {
        // Theme toggle is primarily JS-based for immediate UI updates
        // This method can be used for server-side theme preference storage if needed
    }

    public function render()
    {
        return view('livewire.theme-toggle');
    }
}
