<?php

namespace App\Livewire\Forms\Traits;

trait HasFormValidation
{
    protected $validationMessages = [];
    protected $validationAttributes = [];

    protected function setupValidation(): void
    {
        // Override in child classes to customize messages and attributes
    }

    protected function validateForm(): array
    {
        $this->setupValidation();

        return $this->validate(
            $this->rules(),
            $this->validationMessages,
            $this->validationAttributes
        );
    }

    abstract protected function rules(): array;

    protected function hasErrors(): bool
    {
        return count($this->getErrorBag()->messages()) > 0;
    }

    protected function getFieldErrors($field): array
    {
        return $this->getErrorBag()->get($field) ?? [];
    }

    protected function hasFieldError($field): bool
    {
        return $this->getErrorBag()->has($field);
    }

    protected function getFirstFieldError($field): ?string
    {
        $errors = $this->getFieldErrors($field);
        return $errors[0] ?? null;
    }
}
