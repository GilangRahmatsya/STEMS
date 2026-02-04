{{-- Theme Toggle Component --}}
<button @click="theme = theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', theme); window.dispatchEvent(new CustomEvent('theme-change', { detail: theme }));"
        class="inline-flex items-center justify-center p-2 rounded-lg border transition-all duration-300"
        :class="theme === 'dark' 
            ? 'bg-zinc-800 border-zinc-700 text-yellow-400 hover:bg-zinc-700' 
            : 'bg-gray-100 border-gray-300 text-gray-600 hover:bg-gray-200'">
    <svg x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
    </svg>
    <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1m-16 0H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
    </svg>
</button>
