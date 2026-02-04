#!/bin/bash

echo "Starting deployment optimizations..."

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear other caches
php artisan cache:clear

echo "Deployment optimizations complete!"
