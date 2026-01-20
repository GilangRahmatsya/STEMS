{{-- 
  COMPREHENSIVE RESPONSIVE UI DESIGN GUIDE
  Mobile-First Approach for Phone, Tablet, Desktop
  
  Tailwind Breakpoints:
  - sm: 640px (tablets)
  - md: 768px (tablets/small desktops)
  - lg: 1024px (desktops)
  - xl: 1280px (large screens)
  - 2xl: 1536px (wide screens)
--}}

<div class="space-y-6 text-gray-600 dark:text-gray-300 text-sm">
  
  {{-- ========== GRID LAYOUTS ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Grid Layouts (Mobile-First)</h3>
    
    {{-- 1-2-4 Column Grid --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4"
    </p>
    <p class="text-xs">Mobile: 1 col | Tablet: 2 cols | Desktop: 4 cols with responsive gaps</p>
    
    {{-- 1-2-3 Column Grid --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4"
    </p>
    <p class="text-xs">For analytics cards and smaller stat blocks</p>
    
    {{-- 1-2 Column Grid (Two-column layout) --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6"
    </p>
    <p class="text-xs">Stacks on mobile, shows side-by-side on desktop</p>
  </section>
  
  {{-- ========== TEXT SIZING ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Text Sizing (Responsive Font Sizes)</h3>
    
    {{-- Main Heading --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="text-2xl sm:text-3xl lg:text-4xl font-bold"
    </p>
    <p class="text-xs">Page headings: 24px (mobile) → 30px (tablet) → 36px (desktop)</p>
    
    {{-- Secondary Heading --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="text-lg sm:text-xl lg:text-2xl font-semibold"
    </p>
    <p class="text-xs">Section titles: 18px → 20px → 24px</p>
    
    {{-- Body Text --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="text-sm sm:text-base"
    </p>
    <p class="text-xs">Regular text: 14px (mobile) → 16px (tablet+)</p>
    
    {{-- Label/Helper Text --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="text-xs sm:text-sm"
    </p>
    <p class="text-xs">Labels, captions: 12px → 14px</p>
    
    {{-- Metric Values --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="text-xl sm:text-2xl lg:text-3xl font-bold"
    </p>
    <p class="text-xs">Numbers, stats: 20px → 24px → 30px</p>
  </section>
  
  {{-- ========== SPACING & PADDING ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Spacing & Padding (Responsive Spacing)</h3>
    
    {{-- Container Padding --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="px-4 py-6 sm:px-6 lg:px-8"
    </p>
    <p class="text-xs">Main container: 16px horiz (mobile) → 24px → 32px with 24px vert padding</p>
    
    {{-- Card Padding --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="p-4 sm:p-6"
    </p>
    <p class="text-xs">Individual cards: 16px (mobile) → 24px (tablet+)</p>
    
    {{-- Flex/Grid Gaps --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="gap-3 sm:gap-4 lg:gap-6"
    </p>
    <p class="text-xs">Spacing between items: 12px (mobile) → 16px (tablet) → 24px (desktop)</p>
    
    {{-- Margin/Spacing Utilities --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="mb-4 sm:mb-6 lg:mb-8"
    </p>
    <p class="text-xs">Vertical spacing between sections scales with screen size</p>
  </section>
  
  {{-- ========== ICON & BUTTON SIZING ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Icon & Button Sizing</h3>
    
    {{-- Regular Icon --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="w-6 h-6 sm:w-8 sm:h-8"
    </p>
    <p class="text-xs">Standard icon: 24px (mobile) → 32px (tablet+)</p>
    
    {{-- Small Icon --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="w-5 h-5 sm:w-6 sm:h-6"
    </p>
    <p class="text-xs">Small icon: 20px → 24px</p>
    
    {{-- Button Padding (Touch-Friendly) --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="px-3 py-2 sm:px-4 sm:py-2"
    </p>
    <p class="text-xs">Buttons: 24px min height on mobile (accessibility), 32px on tablet+</p>
  </section>
  
  {{-- ========== FLEXBOX LAYOUTS ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Flexbox Layouts (Responsive Direction)</h3>
    
    {{-- Stack Mobile, Row Desktop --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="flex flex-col sm:flex-row items-start sm:items-center gap-3 sm:gap-4"
    </p>
    <p class="text-xs">Stacks vertically on mobile, horizontal on tablet+ with alignment change</p>
    
    {{-- Flex with Responsive Gap --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="flex gap-2 sm:gap-3"
    </p>
    <p class="text-xs">Space between flex items changes with screen size</p>
  </section>
  
  {{-- ========== VISIBILITY & RESPONSIVE TABLES ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Visibility & Responsive Tables</h3>
    
    {{-- Hide on Mobile --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="hidden sm:table-cell"
    </p>
    <p class="text-xs">Hide table column on mobile, show on tablet+</p>
    
    {{-- Hide on Mobile/Tablet --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="hidden md:table-cell"
    </p>
    <p class="text-xs">Hide on mobile/tablet, show on desktop+</p>
    
    {{-- Show Only on Mobile --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="sm:hidden"
    </p>
    <p class="text-xs">Show content only on mobile, hide on tablet+</p>
    
    {{-- Overflow Handling for Tables --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="overflow-x-auto"
    </p>
    <p class="text-xs">Allows horizontal scrolling on mobile for tables</p>
  </section>
  
  {{-- ========== TEXT OVERFLOW & TRUNCATION ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Text Handling (Overflow & Truncation)</h3>
    
    {{-- Simple Truncate --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="truncate"
    </p>
    <p class="text-xs">Truncate long text with ellipsis (single line)</p>
    
    {{-- Truncate with Max Width --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="truncate max-w-xs"
    </p>
    <p class="text-xs">Combine truncate with max width for controlled overflow</p>
    
    {{-- Min Width (Flex Context) --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="min-w-0"
    </p>
    <p class="text-xs">Allow flex items to shrink below content size</p>
  </section>
  
  {{-- ========== HOVER & TRANSITIONS ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Hover Effects & Transitions (Desktop Enhancement)</h3>
    
    {{-- Hover Shadow --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="hover:shadow-lg transition-shadow"
    </p>
    <p class="text-xs">Desktop hover effects (automatically disabled on touch devices)</p>
    
    {{-- Border Hover --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="hover:border-gray-600 transition-colors"
    </p>
    <p class="text-xs">Smooth color transitions on hover</p>
  </section>
  
  {{-- ========== FORM ELEMENTS ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Form Elements (Touch-Friendly)</h3>
    
    {{-- Input Field --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="w-full text-sm border-gray-300 rounded-md"
    </p>
    <p class="text-xs">Full width inputs with consistent styling</p>
    
    {{-- Form Grid --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="grid grid-cols-1 sm:grid-cols-2 gap-4"
    </p>
    <p class="text-xs">Stack form fields on mobile, 2-column on tablet+</p>
    
    {{-- Label Styling --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="block text-xs sm:text-sm font-medium mb-2"
    </p>
    <p class="text-xs">Responsive label sizing with consistent spacing</p>
  </section>
  
  {{-- ========== MODALS & DIALOGS ========== --}}
  <section>
    <h3 class="font-bold text-lg mb-3">Modals & Dialogs</h3>
    
    {{-- Modal Width --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2">
      class="w-full sm:w-96 lg:w-1/2"
    </p>
    <p class="text-xs">Full width on mobile, fixed width on tablet, percentage on desktop</p>
    
    {{-- Modal Padding --}}
    <p class="font-mono bg-gray-100 dark:bg-gray-800 p-2 rounded mb-2 mt-3">
      class="p-4 sm:p-6"
    </p>
    <p class="text-xs">Responsive padding inside modals</p>
  </section>
  
  {{-- ========== PRACTICAL EXAMPLE ========== --}}
  <section class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
    <h3 class="font-bold text-lg mb-3">Complete Responsive Card Example</h3>
    <p class="font-mono bg-white dark:bg-gray-800 p-3 rounded text-xs overflow-x-auto">
&lt;div class="px-4 py-6 sm:px-6 lg:px-8"&gt;<br>
  &lt;div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4"&gt;<br>
    &lt;div class="p-4 sm:p-6 hover:shadow-lg transition-shadow rounded-lg"&gt;<br>
      &lt;p class="text-xs sm:text-sm font-medium"&gt;Title&lt;/p&gt;<br>
      &lt;p class="text-xl sm:text-2xl lg:text-3xl font-bold mt-2"&gt;{{ $value }}&lt;/p&gt;<br>
    &lt;/div&gt;<br>
  &lt;/div&gt;<br>
&lt;/div&gt;
    </p>
  </section>
  
</div>
