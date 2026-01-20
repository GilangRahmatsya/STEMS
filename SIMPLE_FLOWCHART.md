# STEMS Project - Simple ASCII Flowchart

```
┌─────────────────┐
│   User Access   │
│   Application   │
└─────────┬───────┘
          │
          ▼
┌─────────────────┐     ┌─────────────────┐
│ Check           │────▶│   Login Page    │
│ Authentication  │     └─────────┬───────┘
└─────────┬───────┘               │
          │                       ▼
          ▼              ┌─────────────────┐
┌─────────────────┐     │ Laravel Fortify │
│   Dashboard     │◀────│ Authentication  │
│                 │     └─────────────────┘
└─────────┬───────┘
          │
          ▼
┌─────────────────┐
│ Navigation     │
│ Options        │
└─────────┬───────┘
          │
    ┌─────┼─────┐
    │     │     │
    ▼     ▼     ▼
┌─────┐ ┌─────┐ ┌─────┐
│Items│ │Rentals│ │Create│
│     │ │      │ │Rental│
└─────┘ └─────┘ └─────┘
    │     │         │
    ▼     ▼         ▼
┌─────┐ ┌─────┐ ┌─────┐
│Browse│ │View │ │Select│
│&     │ │My   │ │Items │
│Filter│ │Rentals│ │     │
└─────┘ └─────┘ └─────┘
                        │
                        ▼
               ┌─────────────────┐
               │ Submit Rental   │
               │ Request         │
               └─────────┬───────┘
                         │
                         ▼
               ┌─────────────────┐
               │ Status: Pending │
               │ Approval        │
               └─────────────────┘

ADMIN FLOW:
┌─────────────────┐
│   Dashboard     │
│   (Admin)       │
└─────────┬───────┘
          │
    ┌─────┼─────┐
    │     │     │
    ▼     ▼     ▼
┌─────┐ ┌─────┐ ┌─────┐
│Manage│ │Approve│ │Financial│
│Items │ │Rentals│ │Reports │
└─────┘ └─────┘ └─────┘
```

## Key Components:

### Models:
- **User**: Authentication & profile
- **Item**: Equipment inventory
- **Rental**: Rental transactions
- **Category**: Item categorization
- **FinancialRecord**: Income/expense tracking
- **PhotoboothQueue**: Photobooth service queue

### Livewire Components:
- **Dashboard**: Main user dashboard
- **Items**: Browse equipment
- **Rentals**: Manage rentals
- **CreateRental**: Single item rental
- **CreateBulkRental**: Multiple items rental
- **Financial**: Financial records
- **Reports**: User reports
- **Analytics**: Data analytics
- **Admin/***: Admin management components

### Authentication:
- Laravel Fortify for login/registration
- Role-based access (User/Admin)
- Session-based authentication

### Features:
- Equipment browsing & filtering
- Rental request system
- Approval workflow
- Financial tracking
- Reporting & analytics
- Photobooth queue management
- Admin management tools