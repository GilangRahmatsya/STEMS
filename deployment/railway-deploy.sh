#!/bin/bash

echo "Starting deployment optimizations..."

# Fix MySQL authentication plugin mismatch (for PHP compatibility)
echo "Ensuring MySQL authentication compatibility..."
mysql -h $DB_HOST -u $DB_USERNAME -p$DB_PASSWORD -P $DB_PORT -e "ALTER USER '$DB_USERNAME'@'%' IDENTIFIED WITH mysql_native_password BY '$DB_PASSWORD'; FLUSH PRIVILEGES;" || echo "Notice: MySQL auth fix skipped or already applied."

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Clear other caches
php artisan cache:clear

echo "Deployment optimizations complete!"
