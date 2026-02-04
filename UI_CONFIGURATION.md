# STEMS Project UI Configuration

## Overview
STEMS menggunakan Tailwind CSS dengan dark mode support. Aplikasi memiliki dua tema: Light dan Dark yang dapat diatur melalui theme toggle.

## Key Files untuk Theme Management

### 1. Layout Files
```
resources/views/layouts/
├── app/
│   ├── sidebar.blade.php      - Main layout dengan sidebar
│   └── header.blade.php       - Layout dengan header navbar
└── auth/
    └── simple.blade.php       - Auth layout untuk login/register
```

### 2. Component Files
```
resources/views/components/
├── app-logo.blade.php         - STEMS logo component
├── theme-toggle.blade.php     - Theme toggle button
└── theme-*.blade.php          - Theme-related components
```

### 3. View Partials
```
resources/views/partials/
├── head.blade.php             - <head> section dengan theme init
└── settings-heading.blade.php - Heading untuk settings pages
```

### 4. Main Views
```
resources/views/
├── dashboard.blade.php        - User dashboard
├── welcome.blade.php          - Welcome page
└── livewire/
    ├── items.blade.php        - Items listing
    ├── rentals.blade.php      - Rentals listing
    ├── create-rental.blade.php - Create rental form
    └── ... (other components)
```

## Theme Implementation Details

### Dark Mode Enabled
```html
<html class="dark">  <!-- Activated when dark theme is enabled -->
```

### Local Storage Key
- Key: `theme`
- Values: `'light'` or `'dark'`
- Default: `'light'`

### Theme Change Event
```javascript
// Dispatched when theme changes
window.dispatchEvent(new CustomEvent('theme-change', { detail: 'dark' }));
```

### CSS Utilities
Menggunakan Tailwind's dark mode class strategy:
```html
<!-- Light Mode (default) -->
<div class="bg-white text-gray-900">...</div>

<!-- Dark Mode (with dark: prefix) -->
<div class="bg-white dark:bg-zinc-900 text-gray-900 dark:text-white">...</div>
```

## Breaking Down the Theme System

### 1. Initialization (head.blade.php)
```javascript
<script>
    // Read theme from localStorage on page load
    const theme = localStorage.getItem('theme') || 'light';
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>
```

### 2. Toggle Button (theme-toggle.blade.php)
```blade
<!-- Alpine.js component for theme toggling -->
<button @click="theme = theme === 'dark' ? 'light' : 'dark';"
        class="inline-flex items-center justify-center p-2 rounded-lg">
```

### 3. Storage & Dispatch (header.blade.php)
```javascript
<script>
window.toggleTheme = function() {
    const current = localStorage.getItem('theme') || 'light';
    const newTheme = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', newTheme);
    document.documentElement.classList.toggle('dark', newTheme === 'dark');
    window.dispatchEvent(new CustomEvent('theme-change', { detail: newTheme }));
};
</script>
```

### 4. Alpine.js Reactivity (HTML)
```blade
<html x-data="{ theme: localStorage.getItem('theme') || 'light' }" 
      :class="theme === 'dark' ? 'dark' : ''"
      @theme-change.window="theme = $event.detail">
```

## Style Guide for New Components

When creating new components, follow this pattern:

```blade
<!-- Container -->
<div class="bg-white dark:bg-zinc-900
            border border-gray-200 dark:border-zinc-800
            rounded-lg p-6">
    
    <!-- Heading -->
    <h1 class="text-2xl font-bold 
              text-gray-900 dark:text-white
              mb-4">Title</h1>
    
    <!-- Paragraph -->
    <p class="text-sm text-gray-600 dark:text-gray-400
             mb-6">Description</p>
    
    <!-- Button -->
    <button class="bg-blue-600 hover:bg-blue-700
                   dark:bg-blue-600 dark:hover:bg-blue-700
                   text-white px-4 py-2 rounded-md
                   transition-colors duration-200">
        Action
    </button>
</div>
```

## Background Images

Located in `public/images/`:
- `lightmode background.png` - Light theme background
- `darkmode backgorund.png`  - Dark theme background

Used in login page:
```blade
:style="darkMode ? 'background-image: url(/images/darkmode%20backgorund.png)' : 'background-image: url(/images/lightmode%20background.png)'"
```

## STEMS Logo

Located in `public/images/`:
- `stems-logo.png` - Main STEMS logo

Used in:
- Header/Navbar: `<x-app-logo />`
- Sidebar: `<x-app-logo :sidebar="true" />`
- Login page: Direct image tag

## Tailwind Configuration

The project uses Tailwind CSS with these dark mode settings:
```javascript
// tailwind.config.js (implicit)
darkMode: 'class'  // Uses class-based dark mode
```

When dark mode is enabled, Tailwind prefixes dark mode utilities with `dark:`.

## Browser DevTools Inspection

### Check Current Theme
```javascript
// In browser console
localStorage.getItem('theme')  // Returns: 'light' or 'dark'
document.documentElement.classList  // Check if 'dark' class is present
```

### Manually Toggle Theme
```javascript
// In browser console
localStorage.setItem('theme', 'dark');
document.documentElement.classList.add('dark');
window.dispatchEvent(new CustomEvent('theme-change', { detail: 'dark' }));
```

## Common Issues & Solutions

### Theme Not Persisting After Refresh
- Check if localStorage is enabled in browser
- Verify `head.blade.php` is included in layout
- Clear browser cache and localStorage

### Dark Mode Not Applying
- Ensure `dark:` classes are used correctly
- Check if HTML has `class="dark"` attribute
- Rebuild CSS with `npm run build`

### Theme Toggle Not Working
- Verify Alpine.js is loaded
- Check if `toggleTheme` function is defined
- Check browser console for errors

## Performance Considerations

1. **CSS Size**: Dark mode adds ~10-15% to CSS file size
2. **Runtime Performance**: Theme toggle is near-instant
3. **localStorage**: Used instead of database for performance
4. **Transitions**: Smooth 300ms transitions for better UX

## Future Enhancements

- [ ] Add system theme detection (prefers-color-scheme)
- [ ] Add theme scheduling (auto-switch at certain times)
- [ ] Add custom color themes
- [ ] Add theme preview before applying
- [ ] Add theme persistence in user profile (when logged in)

---

**Version**: 1.0
**Last Updated**: 2026-01-25
**Maintained By**: STEMS Development Team
