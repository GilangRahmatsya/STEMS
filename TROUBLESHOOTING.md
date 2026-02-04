# STEMS Login 500 Error - Troubleshooting Guide

## Step 1: Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## Step 2: Check Application Setup
```bash
# Run diagnostics
php artisan app:diagnose

# Check logs
tail -f storage/logs/laravel.log
```

## Step 3: Fix Permissions
```bash
# Fix storage and cache permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

# If using Linux/Mac with specific user
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
```

## Step 4: Run Migrations
```bash
# Check migration status
php artisan migrate:status

# Run pending migrations
php artisan migrate

# If database issues, reset (WARNING: Data loss)
php artisan migrate:refresh --seed
```

## Step 5: Verify Configuration
```bash
# Check .env file exists
ls -la .env

# Verify database file (SQLite)
ls -la database/stems.sqlite

# Test database connection
php artisan tinker
>>> DB::connection()->getPdo();
```

## Step 6: Check Livewire
```bash
# Discover Livewire components
php artisan livewire:discover
```

## Common Issues & Solutions

### Database File Missing
```bash
# Create SQLite database
touch database/stems.sqlite
php artisan migrate
```

### Migration Files Not Found
```bash
# Ensure migration files exist in database/migrations/
ls database/migrations/

# If empty, create tables manually or re-run setup
```

### Permission Denied Errors
```bash
# Check current permissions
ls -la storage/
ls -la bootstrap/cache/

# Fix permissions
chmod -R 775 storage/ bootstrap/cache/
```

### Livewire View Not Found
```bash
# Verify view files exist
ls resources/views/livewire/auth/

# Check component namespace in app/Livewire/Auth/Login.php
```

## Debug Mode
To see full error details, set in `.env`:
```
APP_DEBUG=true
APP_ENV=local
```

Then check `storage/logs/laravel.log` for detailed errors.

## Still Having Issues?
1. Run: `php artisan app:diagnose`
2. Check logs: `tail -f storage/logs/laravel.log`
3. Verify database: `php artisan tinker` → `DB::connection()->getPdo();`
4. Clear everything: `php artisan cache:clear && php artisan config:clear && php artisan route:clear && php artisan view:clear`
