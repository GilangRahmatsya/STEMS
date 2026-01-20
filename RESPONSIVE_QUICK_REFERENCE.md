# Quick Reference: Responsive Design Patterns

## Mobile-First Responsive Classes

### Container Padding
```html
<!-- Mobile: 16px horizontal | Tablet: 24px | Desktop: 32px -->
<div class="px-4 py-6 sm:px-6 lg:px-8">
```

### Grid Layouts
```html
<!-- 1 column → 2 columns (tablet) → 4 columns (desktop) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

<!-- 1 column → 2 columns (tablet) → 3 columns (desktop) -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">

<!-- Stack on mobile → Side-by-side on desktop -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
```

### Text Sizing
```html
<!-- Page Heading: 24px → 30px → 36px -->
<h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">

<!-- Section Title: 18px → 20px → 24px -->
<h2 class="text-lg sm:text-xl lg:text-2xl font-semibold">

<!-- Label/Small: 12px → 14px -->
<label class="text-xs sm:text-sm">

<!-- Body Text: 14px → 16px -->
<p class="text-sm sm:text-base">

<!-- Large Metrics: 20px → 24px → 30px -->
<p class="text-xl sm:text-2xl lg:text-3xl font-bold">
```

### Spacing Scales
```html
<!-- Card/Box Padding: 16px → 24px -->
<div class="p-4 sm:p-6">

<!-- Grid Gaps: 12px → 16px → 24px -->
<div class="gap-3 sm:gap-4 lg:gap-6">

<!-- Flex Gaps: 8px → 12px -->
<div class="gap-2 sm:gap-3">

<!-- Margin Bottom: 16px → 24px -->
<div class="mb-4 sm:mb-6">
```

### Icon Sizing
```html
<!-- Regular: 24px → 32px -->
<svg class="w-6 h-6 sm:w-8 sm:h-8">

<!-- Small: 20px → 24px -->
<svg class="w-5 h-5 sm:w-6 sm:h-6">

<!-- Large: 32px → 48px -->
<svg class="w-8 h-8 sm:w-12 sm:h-12">
```

### Flexbox Layouts
```html
<!-- Stack on mobile, row on desktop -->
<div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4">

<!-- Row with responsive gap -->
<div class="flex gap-2 sm:gap-3">
```

### Table Responsiveness
```html
<!-- Hide on mobile, show on tablet -->
<th class="hidden sm:table-cell">Type</th>

<!-- Hide on mobile/tablet, show on desktop -->
<th class="hidden md:table-cell">Category</th>

<!-- Scrollable on mobile -->
<div class="overflow-x-auto">
  <table class="min-w-full">
```

### Text Overflow
```html
<!-- Truncate single line -->
<p class="truncate">Long text...</p>

<!-- Truncate with max width -->
<p class="truncate max-w-xs">{{ $value }}</p>

<!-- Multi-line truncation -->
<div class="line-clamp-3">Multiline text...</div>
```

### Visibility
```html
<!-- Show only on mobile -->
<div class="sm:hidden">Mobile content</div>

<!-- Hide on mobile -->
<div class="hidden sm:block">Tablet+ content</div>

<!-- Hide on mobile/tablet -->
<div class="hidden lg:block">Desktop only</div>
```

### Forms
```html
<!-- Full width input -->
<input class="w-full text-sm border rounded">

<!-- Form grid: stack → 2 columns -->
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">

<!-- Stacked form: mobile → row on tablet -->
<div class="flex flex-col sm:flex-row gap-3 sm:gap-4">

<!-- Label sizing -->
<label class="block text-xs sm:text-sm font-medium mb-2">

<!-- Responsive button -->
<button class="w-full sm:w-auto px-4 sm:px-6 py-2">
```

### Hover Effects (Desktop Only)
```html
<!-- Hover shadow - disable on mobile/touch -->
<div class="hover:shadow-lg transition-shadow">

<!-- Hover color change -->
<div class="hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">

<!-- Hover border -->
<div class="hover:border-gray-600 transition-colors">
```

---

## Complete Component Examples

### Stat Card
```html
<div class="p-4 sm:p-6 border rounded-lg hover:shadow-lg transition-shadow">
  <div class="flex flex-col sm:flex-row sm:items-center gap-3">
    <div class="p-2 bg-blue-100 rounded w-fit">
      <svg class="w-5 h-5 sm:w-6 sm:h-6"><!-- icon --></svg>
    </div>
    <div>
      <p class="text-xs sm:text-sm font-medium">Label</p>
      <p class="text-xl sm:text-2xl lg:text-3xl font-bold">{{ $value }}</p>
    </div>
  </div>
</div>
```

### Responsive Form
```html
<form class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
  <div>
    <label class="block text-xs sm:text-sm font-medium mb-2">Field</label>
    <input class="w-full text-sm border rounded">
  </div>
  
  <div>
    <label class="block text-xs sm:text-sm font-medium mb-2">Field</label>
    <input class="w-full text-sm border rounded">
  </div>
  
  <div class="sm:col-span-2">
    <button class="w-full sm:w-auto px-4 sm:px-6 py-2">Submit</button>
  </div>
</form>
```

### Responsive Table
```html
<div class="overflow-x-auto">
  <table class="min-w-full">
    <thead>
      <tr>
        <th class="px-4 sm:px-6">Name</th>
        <th class="px-4 sm:px-6 hidden sm:table-cell">Type</th>
        <th class="px-4 sm:px-6 hidden md:table-cell">Category</th>
        <th class="px-4 sm:px-6">Price</th>
      </tr>
    </thead>
    <tbody>
      <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-4 sm:px-6 py-4">Item</td>
        <td class="px-4 sm:px-6 py-4 hidden sm:table-cell">Type</td>
        <td class="px-4 sm:px-6 py-4 hidden md:table-cell">Cat</td>
        <td class="px-4 sm:px-6 py-4">$99</td>
      </tr>
    </tbody>
  </table>
</div>
```

### Two-Column Layout
```html
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
  <div class="bg-white p-4 sm:p-6 rounded-lg">
    <h3 class="text-base sm:text-lg font-semibold mb-4">Section 1</h3>
    <!-- content -->
  </div>
  
  <div class="bg-white p-4 sm:p-6 rounded-lg">
    <h3 class="text-base sm:text-lg font-semibold mb-4">Section 2</h3>
    <!-- content -->
  </div>
</div>
```

---

## Breakpoint Reference

| Breakpoint | Min Width | Common Devices |
|------------|-----------|-----------------|
| None | 0px (mobile) | Phones (320-640px) |
| `sm:` | 640px | Tablets & landscape phones |
| `md:` | 768px | Medium tablets |
| `lg:` | 1024px | Desktops & large tablets |
| `xl:` | 1280px | Large desktops |
| `2xl:` | 1536px | Ultra-wide screens |

---

## Common Patterns

### Container
```html
<div class="px-4 py-6 sm:px-6 lg:px-8 max-w-7xl mx-auto">
```

### Heading
```html
<h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold">
```

### Card
```html
<div class="bg-white dark:bg-zinc-900 p-4 sm:p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
```

### Button
```html
<button class="px-4 sm:px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
```

---

## Testing Devices

### Mobile
- iPhone SE: 375px
- iPhone 13: 390px
- Android: 360px-412px

### Tablet  
- iPad Mini: 768px
- iPad: 820px
- Android Tab: 600px-960px

### Desktop
- Standard: 1366px
- Large: 1920px
- Ultra: 2560px+

---

## Quick Wins

1. Always start with mobile defaults (no breakpoint prefix)
2. Add `sm:` for tablet improvements
3. Add `lg:` for desktop enhancements
4. Use `hidden` with breakpoints for conditional display
5. Test on real devices, not just DevTools
6. Use `max-w-` utilities to constrain width
7. Apply `mx-auto` for centering
8. Use `truncate` for long text
9. Add `transition-` for smooth effects
10. Always include dark mode classes (`dark:`)

---

**Last Updated:** 2025
**Framework:** Tailwind CSS 3+
**Approach:** Mobile-First Responsive Design
