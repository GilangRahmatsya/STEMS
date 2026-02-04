<div x-data="themeToggle()" x-init="init()" class="inline-flex">
    <button
        @click="toggleTheme()"
        class="relative inline-flex items-center justify-center w-10 h-10 rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors duration-300"
        :aria-label="isDarkMode ? 'Switch to light mode' : 'Switch to dark mode'"
        title="Toggle theme"
    >
        <!-- Sun icon (visible in light mode) -->
        <svg
            x-show="!isDarkMode"
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1m-16 0H1m15.364 1.636l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Moon icon (visible in dark mode) -->
        <svg
            x-show="isDarkMode"
            class="w-5 h-5"
            fill="currentColor"
            viewBox="0 0 24 24"
        >
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
        </svg>
    </button>
</div>

<script>
    function themeToggle() {
        return {
            isDarkMode: false,

            init() {
                // Check localStorage for saved preference
                const saved = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                this.isDarkMode = saved ? saved === 'dark' : prefersDark;
                this.applyTheme();
            },

            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                this.applyTheme();
            },

            applyTheme() {
                const html = document.documentElement;

                if (this.isDarkMode) {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            },
        };
    }
</script>
