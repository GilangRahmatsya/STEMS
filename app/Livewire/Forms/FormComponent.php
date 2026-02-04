<?php

namespace App\Livewire\Forms;

use Livewire\Component;

abstract class FormComponent extends Component
{
    public $isDarkMode = false;
    public $isSubmitting = false;
    public $formTitle = '';
    public $formDescription = '';

    public function mount()
    {
        $this->initializeForm();
    }

    abstract protected function initializeForm();

    protected function getInputClass($hasError = false): string
    {
        $baseClass = 'w-full px-4 py-2.5 rounded-lg border transition-all duration-200';
        $lightClass = 'bg-neutral-50 border-neutral-300 text-neutral-900 placeholder-neutral-500';
        $darkClass = 'dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:placeholder-neutral-400';
        $focusClass = 'focus:outline-none focus:ring-2 focus:ring-offset-0 focus:border-transparent';
        $errorClass = $hasError ? 'border-danger-500 dark:border-danger-500 focus:ring-danger-500 dark:focus:ring-danger-500' : 'focus:ring-primary-500 dark:focus:ring-primary-500';

        return "$baseClass $lightClass $darkClass $focusClass $errorClass";
    }

    protected function getLabelClass(): string
    {
        return 'block text-sm font-semibold text-neutral-900 dark:text-white mb-2';
    }

    protected function getHelperTextClass(): string
    {
        return 'mt-1 text-xs text-neutral-600 dark:text-neutral-400';
    }

    protected function getErrorClass(): string
    {
        return 'mt-1 text-sm text-danger-600 dark:text-danger-400 font-medium';
    }

    protected function getButtonClass($variant = 'primary'): string
    {
        $baseClass = 'px-6 py-2.5 rounded-lg font-semibold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-neutral-900 disabled:opacity-50 disabled:cursor-not-allowed';

        return match($variant) {
            'primary' => "$baseClass bg-gradient-to-r from-primary-600 to-secondary-600 hover:from-primary-700 hover:to-secondary-700 text-white focus:ring-primary-500",
            'secondary' => "$baseClass bg-secondary-600 hover:bg-secondary-700 text-white focus:ring-secondary-500",
            'danger' => "$baseClass bg-danger-600 hover:bg-danger-700 text-white focus:ring-danger-500",
            'ghost' => "$baseClass bg-neutral-100 dark:bg-neutral-800 text-neutral-900 dark:text-white hover:bg-neutral-200 dark:hover:bg-neutral-700 focus:ring-neutral-500",
            default => $baseClass,
        };
    }

    protected function getSelectClass($hasError = false): string
    {
        return $this->getInputClass($hasError);
    }

    protected function getTextareaClass($hasError = false): string
    {
        $base = $this->getInputClass($hasError);
        return "$base resize-vertical min-h-[120px]";
    }

    public function render()
    {
        return view('livewire.forms.form-component');
    }
}
