# STEMS Theme Quick Reference

## 🎨 Instant Color Guide

### Light Mode Palette
```
White (bg)      → bg-white
Gray (surface)  → bg-gray-50
Border          → border-gray-200
Text Primary    → text-gray-900
Text Secondary  → text-gray-600
```

### Dark Mode Palette
```
Black (bg)      → dark:bg-zinc-950
Dark (surface)  → dark:bg-zinc-900
Border          → dark:border-zinc-800
Text Primary    → dark:text-white
Text Secondary  → dark:text-gray-400
```

### Accent Colors
```
✅ Success      → emerald-600 / dark:emerald-400
ℹ️ Info         → blue-600 / dark:blue-400
⚠️ Warning      → amber-600 / dark:amber-400
❌ Error        → red-600 / dark:red-400
💜 Primary      → rose-600 / dark:rose-400
```

## 🔧 Copy-Paste Snippets

### Basic Card
```blade
<div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-lg p-6">
    Content here
</div>
```

### Primary Button
```blade
<button class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors">
    Click Me
</button>
```

### Input Field
```blade
<input type="text" 
       class="w-full px-3 py-2 rounded-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:focus:border-blue-400" />
```

### Alert Box
```blade
<div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
    <p class="text-blue-900 dark:text-blue-400">Alert message</p>
</div>
```

### Stats Card
```blade
<div class="bg-white dark:bg-zinc-900 border border-gray-200 dark:border-zinc-800 rounded-lg p-4">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400">Label</p>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">123</h3>
        </div>
        <div class="bg-blue-100 dark:bg-blue-900/30 p-3 rounded-full">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400"><!-- icon --></svg>
        </div>
    </div>
</div>
```

## 📋 Checklist for New Pages

When creating new pages/components:

- [ ] Use `bg-white dark:bg-zinc-900` for main containers
- [ ] Use `border-gray-200 dark:border-zinc-800` for borders
- [ ] Use `text-gray-900 dark:text-white` for primary text
- [ ] Use `text-gray-600 dark:text-gray-400` for secondary text
- [ ] Add `transition-colors duration-300` to interactive elements
- [ ] Test in both light and dark mode
- [ ] Check contrast in both modes

## 🚀 Quick Commands

### Reload Theme
```javascript
// Browser console
location.reload();
```

### Switch to Dark Mode
```javascript
localStorage.setItem('theme', 'dark');
location.reload();
```

### Switch to Light Mode
```javascript
localStorage.setItem('theme', 'light');
location.reload();
```

### Check Current Theme
```javascript
localStorage.getItem('theme')
```

## 📁 Key Files Reference

| File | Purpose |
|------|---------|
| `resources/views/layouts/app/header.blade.php` | Main header with theme toggle |
| `resources/views/layouts/app/sidebar.blade.php` | Sidebar with navigation |
| `resources/views/components/theme-toggle.blade.php` | Theme toggle button |
| `resources/views/partials/head.blade.php` | Theme initialization |
| `public/images/stems-logo.png` | STEMS logo |
| `public/images/lightmode background.png` | Light bg image |
| `public/images/darkmode backgorund.png` | Dark bg image |

## 🎯 Common Tasks

### Change Background Color of Card
```blade
<!-- Change from light to orange -->
<div class="bg-orange-50 dark:bg-orange-900/20">
```

### Change Text Color
```blade
<!-- Change from gray to blue -->
<p class="text-blue-600 dark:text-blue-400">Text</p>
```

### Add Hover Effect
```blade
<div class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
```

### Add Border Color
```blade
<!-- Primary border -->
class="border border-gray-200 dark:border-zinc-800"

<!-- Hover border -->
class="border border-gray-300 dark:border-zinc-700"
```

## 🔍 Debug Tips

### Check if Dark Mode is Active
```html
<!-- This should show/hide based on theme -->
<div x-show="theme === 'dark'">Dark Mode Active</div>
```

### Force Dark Mode for Testing
```javascript
document.documentElement.classList.add('dark');
```

### Force Light Mode for Testing
```javascript
document.documentElement.classList.remove('dark');
```

### Monitor localStorage
```javascript
// Watch localStorage changes
setInterval(() => {
    console.log('Current theme:', localStorage.getItem('theme'));
}, 1000);
```

## 📱 Responsive + Dark Mode

```blade
<!-- Mobile: light bg, Desktop dark: with dark:md: -->
<div class="bg-white dark:bg-zinc-900 md:dark:bg-zinc-950">
```

## ⚡ Performance Tips

1. Use `dark:` prefix instead of custom classes
2. Batch theme-related updates
3. Use `transition-colors` for smooth changes
4. Avoid animations during theme switch
5. Cache theme preference in localStorage

## 🎓 Learning Resources

- [Tailwind Dark Mode Docs](https://tailwindcss.com/docs/dark-mode)
- [Alpine.js Documentation](https://alpinejs.dev)
- [Project Theme Guidelines](./THEME_GUIDELINES.md)
- [UI Configuration](./UI_CONFIGURATION.md)

---

**Pro Tip**: Press `Ctrl+F` to search this document for specific colors or components!

Last Updated: 2026-01-25
