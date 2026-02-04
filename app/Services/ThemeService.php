<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ThemeService
{
    public const LIGHT_THEME = 'light';
    public const DARK_THEME = 'dark';

    /**
     * Get user's theme preference
     */
    public function getUserTheme(): string
    {
        if (Auth::check()) {
            return Auth::user()->theme_preference ?? self::LIGHT_THEME;
        }

        return self::LIGHT_THEME;
    }

    /**
     * Set user's theme preference
     */
    public function setUserTheme(string $theme): void
    {
        if (Auth::check() && in_array($theme, [self::LIGHT_THEME, self::DARK_THEME])) {
            Auth::user()->update(['theme_preference' => $theme]);
        }
    }

    /**
     * Validate theme value
     */
    public function isValidTheme(string $theme): bool
    {
        return in_array($theme, [self::LIGHT_THEME, self::DARK_THEME]);
    }

    /**
     * Get theme class for HTML element
     */
    public function getThemeClass(string $theme): string
    {
        return $theme === self::DARK_THEME ? 'dark' : '';
    }
}
