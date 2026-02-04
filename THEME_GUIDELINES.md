# STEMS Theme Development Guidelines

## Color Palette

### Light Mode
```
Background:      #FFFFFF (bg-white)
Surface:         #F9FAFB (bg-gray-50)
Border:          #E5E7EB (border-gray-200)
Text Primary:    #111827 (text-gray-900)
Text Secondary:  #6B7280 (text-gray-600)

Accent Colors:
- Emerald:  #059669 (emerald-600)
- Blue:     #2563EB (blue-600)
- Amber:    #D97706 (amber-600)
- Rose:     #E11D48 (rose-600)
```

### Dark Mode
```
Background:      #09090B (dark:bg-zinc-950)
Surface:         #18181B (dark:bg-zinc-900)
Border:          #27272A (dark:border-zinc-800)
Text Primary:    #FFFFFF (dark:text-white)
Text Secondary:  #A1A1AA (dark:text-gray-400)

Accent Colors:
- Emerald:  #34D399 (dark:text-emerald-400)
- Blue:     #60A5FA (dark:text-blue-400)
- Amber:    #FBBF24 (dark:text-amber-400)
- Rose:     #FB7185 (dark:text-rose-400)
```

## Component Patterns

### Card Component
```blade
<div class="bg-white dark:bg-zinc-900 
            border border-gray-200 dark:border-zinc-800 
            rounded-lg p-6
            hover:border-gray-300 dark:hover:border-zinc-700
            transition-all duration-300">
    <!-- content -->
</div>
```

### Button Component
```blade
<!-- Primary -->
<button class="bg-blue-600 hover:bg-blue-700 
               dark:bg-blue-600 dark:hover:bg-blue-700
               text-white px-4 py-2 rounded-md
               transition-colors duration-200">
    Action
</button>

<!-- Secondary -->
<button class="bg-gray-200 hover:bg-gray-300
               dark:bg-zinc-700 dark:hover:bg-zinc-600
               text-gray-900 dark:text-white px-4 py-2 rounded-md
               transition-colors duration-200">
    Secondary
</button>
```

### Input Component
```blade
<input type="text" 
       class="w-full px-3 py-2 rounded-md
              border border-gray-300 dark:border-zinc-600
              bg-white dark:bg-zinc-800
              text-gray-900 dark:text-white
              placeholder-gray-400 dark:placeholder-gray-500
              focus:border-blue-500 focus:ring-2 focus:ring-blue-500
              dark:focus:border-blue-400 dark:focus:ring-blue-400
              transition-colors" />
```

### Alert Component
```blade
<!-- Info Alert -->
<div class="bg-blue-50 dark:bg-blue-900/20 
            border border-blue-200 dark:border-blue-800 
            rounded-lg p-4">
    <p class="text-blue-900 dark:text-blue-400">Message</p>
</div>

<!-- Warning Alert -->
<div class="bg-amber-50 dark:bg-amber-900/20 
            border border-amber-200 dark:border-amber-800 
            rounded-lg p-4">
    <p class="text-amber-900 dark:text-amber-400">Message</p>
</div>

<!-- Error Alert -->
<div class="bg-red-50 dark:bg-red-900/20 
            border border-red-200 dark:border-red-800 
            rounded-lg p-4">
    <p class="text-red-900 dark:text-red-400">Message</p>
</div>

<!-- Success Alert -->
<div class="bg-emerald-50 dark:bg-emerald-900/20 
            border border-emerald-200 dark:border-emerald-800 
            rounded-lg p-4">
    <p class="text-emerald-900 dark:text-emerald-400">Message</p>
</div>
```

## Theme Toggle Implementation

### HTML Structure
```blade
<button @click="theme = theme === 'dark' ? 'light' : 'dark'; 
                localStorage.setItem('theme', theme);
                window.dispatchEvent(new CustomEvent('theme-change', { detail: theme }));"
        class="p-2 rounded-lg">
    <svg x-show="theme === 'light'" class="w-5 h-5"><!-- sun icon --></svg>
    <svg x-show="theme === 'dark'" class="w-5 h-5"><!-- moon icon --></svg>
</button>
```

### JavaScript
```javascript
// Initialize theme from localStorage
const theme = localStorage.getItem('theme') || 'light';
if (theme === 'dark') {
    document.documentElement.classList.add('dark');
}

// Toggle theme function
window.toggleTheme = function() {
    const current = localStorage.getItem('theme') || 'light';
    const newTheme = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', newTheme);
    document.documentElement.classList.toggle('dark', newTheme === 'dark');
    window.dispatchEvent(new CustomEvent('theme-change', { detail: newTheme }));
};
```

## Best Practices

### 1. Always Use Pairs
```blade
<!-- ✅ Good -->
<div class="text-gray-900 dark:text-white">Content</div>
<div class="bg-white dark:bg-zinc-900">Card</div>

<!-- ❌ Avoid -->
<div class="text-gray-900">Content</div>
<div class="bg-white">Card</div>
```

### 2. Use Consistent Spacing
- Always include `transition-colors duration-300` untuk smooth theme changes
- Use appropriate opacity classes: `dark:bg-zinc-800/50` untuk layered effects

### 3. Accessibility
- Maintain sufficient contrast in both light and dark modes
- Test with accessibility tools
- Use semantic HTML

### 4. Color Consistency
- Light mode: Use gray-100 to gray-900 scale
- Dark mode: Use zinc-900 to zinc-50 scale
- Accent colors: Use same hue in both modes

## STEMS Logo Usage

### Header
```blade
<x-app-logo href="{{ route('dashboard') }}" />
```

### Sidebar
```blade
<x-app-logo :sidebar="true" href="{{ route('dashboard') }}" />
```

### Login Page
```blade
<img src="/images/stems-logo.png" alt="STEMS Logo" class="w-32 h-32">
```

## Common Color References

| Element | Light | Dark |
|---------|-------|------|
| Background | bg-white | dark:bg-zinc-950 |
| Surface/Card | bg-white | dark:bg-zinc-900 |
| Hover State | hover:bg-gray-50 | dark:hover:bg-zinc-800 |
| Border | border-gray-200 | dark:border-zinc-800 |
| Primary Text | text-gray-900 | dark:text-white |
| Secondary Text | text-gray-600 | dark:text-gray-400 |
| Placeholder | placeholder-gray-400 | dark:placeholder-gray-500 |
| Success | text-emerald-600 | dark:text-emerald-400 |
| Warning | text-amber-600 | dark:text-amber-400 |
| Error | text-red-600 | dark:text-red-400 |
| Info | text-blue-600 | dark:text-blue-400 |

## Testing Theme Implementation

### Manual Testing
1. [ ] Load page in light mode
2. [ ] Load page in dark mode
3. [ ] Toggle between modes
4. [ ] Refresh page - theme persists
5. [ ] Check all text is readable
6. [ ] Check all borders are visible
7. [ ] Check all interactive elements work
8. [ ] Test on mobile devices

### Accessibility Testing
1. [ ] Contrast ratio >= 4.5:1 for normal text
2. [ ] Contrast ratio >= 3:1 for large text
3. [ ] Test with screen readers
4. [ ] Test with keyboard navigation

---

**Last Updated**: 2026-01-25
**Theme Version**: 1.0
