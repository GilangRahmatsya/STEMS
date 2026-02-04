# 🚀 STEMS UI - Quick Reference Guide

## 📋 What Changed

### Login Page: COMPLETE REDESIGN ✅
- Modern two-column layout
- Professional styling
- Full STEMS branding
- Light & dark theme support
- Mobile responsive

### Branding: FULL REPLACEMENT ✅
- Removed all Laravel references
- STEMS logo on all pages
- Updated app name in config

## 🎯 Key Files Modified

```
resources/views/auth/login.blade.php          ← Login page redesign
resources/views/layouts/app/header.blade.php  ← Navigation cleanup
resources/views/layouts/auth/card.blade.php   ← App name branding
config/app.php                                ← APP_NAME config
```

## 🌈 Theme System

### How It Works
```javascript
// Dark mode toggle in localStorage
localStorage.getItem('theme')  // 'light' or 'dark'
localStorage.setItem('theme', 'dark')

// Applied to HTML element
<html class="dark">...</html>  // Dark mode active
<html>...</html>               // Light mode active
```

### Using Dark Mode Classes
```html
<!-- Light mode only -->
<div class="bg-white">Light</div>

<!-- Dark mode only -->
<div class="dark:bg-zinc-900">Dark</div>

<!-- Both modes -->
<div class="bg-white dark:bg-zinc-900">Both</div>
```

## 🎨 Color Palette

### Light Mode
- Background: `bg-white`
- Text: `text-gray-900`
- Secondary: `text-gray-600`
- Borders: `border-gray-300`

### Dark Mode
- Background: `dark:bg-zinc-950` / `dark:bg-zinc-900`
- Text: `dark:text-white`
- Secondary: `dark:text-gray-300`
- Borders: `dark:border-zinc-800`

### Accent Colors
- Primary: Blue (`from-blue-600 to-blue-500`)
- Success: Emerald
- Warning: Amber
- Danger: Rose

## 🔧 Common Customizations

### Change Button Color
```blade
<!-- Before -->
<button class="bg-blue-600">Button</button>

<!-- After (example with rose) -->
<button class="bg-rose-600">Button</button>
```

### Adjust Form Input Styling
```blade
<!-- Current styling -->
<input class="px-4 py-3 rounded-lg border" 
       :class="darkMode ? 'bg-zinc-800 border-zinc-700' : 'bg-gray-50 border-gray-300'">
```

### Change Logo Size
```blade
<!-- Current -->
<img src="/images/stems-logo.png" class="w-40 h-40">

<!-- Smaller -->
<img src="/images/stems-logo.png" class="w-32 h-32">

<!-- Larger -->
<img src="/images/stems-logo.png" class="w-48 h-48">
```

## 📱 Responsive Breakpoints

```tailwind
Base (mobile):     < 640px  (no prefix)
sm:               640px     (sm: prefix)
md:               768px     (md: prefix)
lg:              1024px     (lg: prefix)
xl:              1280px     (xl: prefix)
2xl:             1536px     (2xl: prefix)
```

### Example Usage
```html
<!-- Mobile first approach -->
<div class="p-4 md:p-8 lg:p-12">
  <!-- p-4 on mobile, p-8 on tablet, p-12 on desktop -->
</div>

<!-- Hide on mobile, show on desktop -->
<div class="hidden lg:flex">
  Visible only on large screens
</div>
```

## 🔍 Image Paths

```bash
# Background Images
/images/lightmode background.png     # Light theme background
/images/darkmode backgorund.png      # Dark theme background (note: typo in filename)

# Logo
/images/stems-logo.png               # STEMS logo (used everywhere)
```

## 🧩 Key Components

### App Logo Component
```blade
<!-- Header -->
<x-app-logo href="{{ route('dashboard') }}" wire:navigate />

<!-- Sidebar -->
<x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
```

### Theme Toggle Component
```blade
<x-theme-toggle />
```

### Form Group
```blade
<div class="space-y-2">
    <label class="block text-sm font-semibold">Label</label>
    <input class="w-full px-4 py-3 rounded-lg border" 
           :class="darkMode ? 'bg-zinc-800 border-zinc-700' : 'bg-gray-50 border-gray-300'">
</div>
```

## 📝 Alpine.js Data Properties

### Login Page
```javascript
x-data="{ 
    darkMode: localStorage.getItem('theme') === 'dark',
    showPassword: false,
    init() {
        this.$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))
    }
}"
```

### Usage
```html
<!-- Bind CSS class -->
:class="darkMode ? 'dark' : ''"

<!-- Bind styles -->
:style="darkMode ? 'background: dark' : 'background: light'"

<!-- Toggle action -->
@click="darkMode = !darkMode"

<!-- Show/hide elements -->
<div x-show="darkMode">Dark Mode</div>
<div x-show="!darkMode">Light Mode</div>
```

## 🚨 Common Issues & Fixes

### Issue: Dark mode not applying
**Fix:**
```blade
<!-- Make sure HTML element has proper class -->
<html :class="darkMode ? 'dark' : ''">
```

### Issue: Images not loading
**Fix:**
- Check image paths in `/public/images/`
- Verify filename case sensitivity
- Use public path helper: `{{ asset('images/logo.png') }}`

### Issue: Theme not persisting
**Fix:**
```blade
<!-- Ensure localStorage is being used -->
localStorage.getItem('theme')
localStorage.setItem('theme', value)
```

### Issue: Form styles inconsistent
**Fix:**
```blade
<!-- Use consistent dark: prefix pattern -->
:class="darkMode ? 'dark-style' : 'light-style'"
```

## 🎯 Best Practices

✅ **DO:**
- Use `dark:` prefixed classes for dark mode
- Use `transition-colors duration-300` for smooth changes
- Test both light and dark modes
- Use semantic color variables
- Keep form consistent across pages

❌ **DON'T:**
- Hard-code color values (use Tailwind)
- Forget dark mode variants
- Use old `dark-mode` pattern
- Mix different theme systems
- Ignore mobile responsiveness

## 📚 Additional Resources

### Tailwind CSS Dark Mode
https://tailwindcss.com/docs/dark-mode

### Alpine.js Documentation
https://alpinejs.dev/

### Flux UI Components
Laravel Flux documentation in your project

## 🔐 Security Notes

- Form validation happens on backend
- No sensitive data in localStorage (only theme)
- CSRF tokens included in forms
- XSS protection via Blade escaping

## 📞 Quick Help

### To test login page:
```bash
php artisan serve --port 8000
# Visit: http://localhost:8000/login
```

### To clear cache:
```bash
php artisan cache:clear
php artisan view:clear
```

### To check errors:
```bash
php artisan log:tail
# Check storage/logs/laravel.log
```

---

## 📖 Documentation Index

| Document | Purpose |
|----------|---------|
| **IMPROVEMENTS_SUMMARY.md** | High-level overview |
| **UI_IMPROVEMENTS.md** | Detailed technical changes |
| **IMPROVEMENTS_CHECKLIST.md** | Verification checklist |
| **This file** | Quick reference for developers |

---

**Last Updated:** January 25, 2026  
**Status:** ✅ Production Ready  
**Version:** 1.0

*For questions or customizations, refer to IMPROVEMENTS_SUMMARY.md or UI_IMPROVEMENTS.md*
