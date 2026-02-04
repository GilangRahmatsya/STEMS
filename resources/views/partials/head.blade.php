<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
@fluxAppearance

<script>
    // Initialize theme from localStorage
    const theme = localStorage.getItem('theme') || 'light';
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
</script>

<style>
.lcp-force {
    content-visibility: visible;
    contain: layout paint;
}
</style>
