# AI Coding Guidelines for STEMS Project

## Architecture Overview
STEMS is a Laravel 12 + Livewire 4 application for equipment rental management with photobooth features. Uses Flux UI components, Tailwind CSS, and SQLite database.

**Key Components:**
- **Models**: `User`, `Item`, `Rental`, `Category`, `FinancialRecord`, `PhotoboothEvent`, `PhotoboothQueue`
- **Livewire Components**: Reactive UI in `app/Livewire/` (user) and `app/Livewire/Admin/` (admin)
- **Routes**: User routes in `/user/*`, Admin routes in `/admin/*` with `can:is-admin` middleware

## Core Patterns

### Livewire Component Structure
```php
class CreateRental extends Component
{
    public $item_id, $start_date, $end_date; // Public properties for form binding
    
    public function mount($itemId) { $this->item_id = $itemId; } // Initialize from route params
    
    public function submit() {
        $this->validate([...]); // Validate before processing
        // Business logic here
        session()->flash('message', 'Success!'); // User feedback
        return redirect()->route('user.rentals.index'); // Route redirection
    }
    
    public function render() {
        return view('livewire.create-rental', ['item' => Item::findOrFail($this->item_id)]);
    }
}
```

### Model Relationships & Business Logic
```php
class Rental extends Model
{
    protected $fillable = ['user_id', 'item_id', 'start_date', 'end_date', 'status', ...];
    protected $casts = ['start_date' => 'date', 'returned_at' => 'datetime'];
    
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function item(): BelongsTo { return $this->belongsTo(Item::class); }
    
    public function getDurationInDays(): int {
        return $this->start_date->diffInDays($this->end_date) + 1; // Inclusive calculation
    }
}
```

### Rental Status Flow
- `pending` → `approved`/`rejected` → `picked_up` → `returned` (with `returned_at` timestamp)
- Payment status: `pending` → `paid` → `refunded`
- KTP verification required for rentals

### Item Availability Logic
```php
public function isAvailable(): bool {
    return $this->status === 'Ready' && $this->condition !== 'Bad' && $this->quantity > 0;
}
```

## Development Workflows

### Setup & Run
```bash
composer install && npm install
php artisan migrate
npm run dev  # Frontend development
php artisan serve  # Backend server
```

### Testing
- Use PHPUnit with SQLite in-memory database
- Tests in `tests/Feature/` and `tests/Unit/`
- Run: `php artisan test`

### Code Quality
- Laravel Pint for formatting: `./vendor/bin/pint`
- Follow PSR-4 autoloading standards

## Key Conventions

### File Organization
- Livewire views: `resources/views/livewire/{component-name}.blade.php`
- Admin components: `app/Livewire/Admin/` namespace
- Migrations: Timestamped with descriptive names

### Validation & Error Handling
- Validate in Livewire `submit()` methods using `$this->validate()`
- Use session flash messages for user feedback
- Handle database constraint errors (see `isUniqueConstraintError()` helper)

### Database Design
- Foreign keys with cascade constraints
- Performance indexes on frequently queried columns
- Use decimal casting for monetary values: `'price' => 'decimal:2'`

### UI Patterns
- Responsive design with Tailwind CSS classes
- Flux UI components for consistent styling
- Mobile-first approach with responsive grids (1-2-4 columns)

## Common Gotchas
- Route parameters use camelCase in Livewire mount methods
- Date calculations are inclusive (start to end +1 day)
- Admin routes require `can:is-admin` gate check
- SQLite as default DB - ensure migrations work with SQLite syntax

## Deployment

### Environment Setup
- Use `.env.example` to create a new `.env` file
- Set `APP_KEY`, `DB_CONNECTION`, and other environment-specific variables
- For production, set `APP_ENV=production` and `APP_DEBUG=false`

### Database Migration & Seeding
- Run migrations: `php artisan migrate --force`
- Seed the database: `php artisan db:seed --force` (optional)

### File Storage
- Ensure `storage` and `bootstrap/cache` directories are writable
- For file uploads, configure cloud storage in `filesystems.php`

### SSL & Security
- Use Let's Encrypt or similar for SSL certificates
- Redirect HTTP to HTTPS in the web server configuration

### Monitoring & Logging
- Configure logging in `config/logging.php`
- Use Laravel Telescope or external services for monitoring (optional)

### 

- Schedule cron jobs for `php artisan schedule:run` every minute
- Optimize the application: `php artisan optimize`