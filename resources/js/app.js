// Tauri window optimization for LCP
// Temporarily disabled for debugging
// if (window.__TAURI__) {
//     window.addEventListener('load', () => {
//         setTimeout(() => {
//             if (window.__TAURI__ && window.__TAURI__.window) {
//                 window.__TAURI__.window.getCurrent().show();
//             }
//         }, 100);
//     });
// }

// Alpine.js for UI interactivity
import Alpine from 'alpinejs';
window.Alpine = Alpine;

// Note: Alpine.start() is called automatically by Livewire
// (via @livewireScripts directive), so we don't call it here
// to avoid the "multiple instances of Alpine" warning

// Disable right-click and refresh for desktop feel
document.addEventListener('contextmenu', e => e.preventDefault());
document.addEventListener('keydown', e => {
    if (e.key === 'F5' || (e.ctrlKey && e.key === 'r') || (e.metaKey && e.key === 'r')) {
        e.preventDefault();
    }
});