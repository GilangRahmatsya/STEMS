<footer class="bg-white dark:bg-gray-800 border-t border-neutral-200 dark:border-neutral-800 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Brand -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <img src="/images/stems-logo.png" alt="STEMS" class="h-8 w-8">
                    <span class="text-lg font-bold">STEMS</span>
                </div>
                <p class="text-sm text-secondary">
                    Swiper Tools & Equipment Management System
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold mb-4">Product</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('user.items.index') }}" class="text-secondary hover:text-primary transition-colors">Browse Items</a></li>
                    <li><a href="{{ route('user.rentals.index') }}" class="text-secondary hover:text-primary transition-colors">My Rentals</a></li>
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Pricing</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h3 class="text-sm font-semibold mb-4">Company</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">About Us</a></li>
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Contact</a></li>
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Blog</a></li>
                </ul>
            </div>

            <!-- Legal -->
            <div>
                <h3 class="text-sm font-semibold mb-4">Legal</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="text-secondary hover:text-primary transition-colors">Cookie Policy</a></li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-neutral-200 dark:border-neutral-800 pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                <p class="text-sm text-secondary">
                    &copy; {{ date('Y') }} STEMS. All rights reserved.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-secondary hover:text-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.29 20v-7.21H5.5V9.25h2.79V7.02c0-2.7 1.65-4.18 4.07-4.18 1.16 0 2.16.09 2.45.13v2.84h-1.68c-1.32 0-1.57.63-1.57 1.55V9.25h3.13l-4.07 3.54v7.21h-3.33z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-secondary hover:text-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-secondary hover:text-primary transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
