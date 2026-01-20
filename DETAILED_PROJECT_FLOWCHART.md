# STEMS (Equipment Rental System) - Detailed Flowchart

## Overview
STEMS is a Laravel-based equipment rental management system that allows users to browse, rent, and manage scientific equipment while providing administrators with comprehensive management tools.

## Main Application Flow

```mermaid
flowchart TD
    %% Entry Points
    START([Application Start]) --> REDIRECT[Redirect to /login]
    REDIRECT --> AUTH{Authentication Check}

    %% Authentication Branch
    AUTH -->|Not Authenticated| LOGIN[Login Page]
    LOGIN --> FORTIFY[Laravel Fortify Authentication]
    FORTIFY --> VALIDATE{Valid Credentials?}
    VALIDATE -->|Invalid| LOGIN
    VALIDATE -->|Valid| DASHBOARD[User Dashboard]

    %% User Dashboard
    DASHBOARD --> STATS[Display Statistics:
    - Available Items
    - Active Rentals
    - Pending Requests
    - Total Spent]

    STATS --> NAVIGATION[Navigation Options]

    %% User Navigation
    NAVIGATION --> ITEMS[Browse Items]
    NAVIGATION --> RENTALS[My Rentals]
    NAVIGATION --> CREATE_RENTAL[Create New Rental]
    NAVIGATION --> FINANCIAL[Financial Records]
    NAVIGATION --> REPORTS[Reports & Analytics]
    NAVIGATION --> PHOTOBOOTH[Photobooth Queues]

    %% Admin Check
    DASHBOARD --> ADMIN_CHECK{User Role: Admin?}
    ADMIN_CHECK -->|Yes| ADMIN_DASH[Admin Dashboard]
    ADMIN_CHECK -->|No| NAVIGATION

    %% Admin Features
    ADMIN_DASH --> ADMIN_ITEMS[Item Management]
    ADMIN_DASH --> ADMIN_RENTALS[Rental Management]
    ADMIN_DASH --> ADMIN_FINANCIAL[Financial Management]
    ADMIN_DASH --> ADMIN_REPORTS[Advanced Reports]
    ADMIN_DASH --> DAMAGED_ITEMS[Damaged Items Tracking]
    ADMIN_DASH --> PHOTOBOOTH_ADMIN[Photobooth Management]

    %% Logout
    DASHBOARD --> LOGOUT[Logout]
    ADMIN_DASH --> LOGOUT
    LOGOUT --> AUTH
```

## Item Browsing & Rental Flow

```mermaid
flowchart TD
    A[Browse Items Page] --> B[Display Item Categories]
    B --> C[Show Items Grid with Filters]
    C --> D[Item Status Indicators:
    - Ready (Available)
    - Rented (Unavailable)
    - Maintenance (Unavailable)]

    D --> E[User Clicks Item]
    E --> F[Item Detail View]
    F --> G[Show Item Information:
    - Name & Description
    - Category & Location
    - Condition & Status
    - Price per day
    - Available Quantity]

    G --> H{Check Availability}
    H -->|Available| I[Show "Rent This Item" Button]
    H -->|Not Available| J[Show "Currently Unavailable"]

    I --> K[Add to Rental Selection]
    K --> L[Continue Browsing / Create Rental]

    J --> M[Show Alternative Items]
    M --> C
```

## Rental Creation Process

```mermaid
flowchart TD
    A[Create Rental Page] --> B[Select Rental Type]
    B --> C{Bulk or Single Item?}

    C -->|Bulk Rental| D[Bulk Rental Form]
    C -->|Single Item| E[Single Item Rental]

    D --> F[Select Multiple Items]
    F --> G[Set Rental Period]
    G --> H[Calculate Total Price]
    H --> I[Fill Borrower Information Form]

    E --> J[Pre-selected Item]
    J --> K[Set Rental Period]
    K --> L[Calculate Price]
    L --> I

    I --> M[Required Information:
    - Borrower Name
    - Birth Date
    - Purpose
    - KTP Status
    - Contact Info]

    M --> N[Review Rental Details]
    N --> O[Submit Rental Request]

    O --> P[Status: Pending Approval]
    P --> Q[Redirect to My Rentals]
```

## Rental Management Flow

```mermaid
flowchart TD
    A[My Rentals Page] --> B[Fetch User Rentals]
    B --> C[Display Rental List with Status]

    C --> D{Rental Status}

    D -->|Pending| E[Show Pending Status]
    E --> F[Display Submission Date]
    F --> G[Wait for Admin Approval]

    D -->|Approved| H[Show Approved Status]
    H --> I[Display Approval Date]
    I --> J[Show Pickup Instructions]
    J --> K[Show Return Deadline]

    D -->|Rejected| L[Show Rejected Status]
    L --> M[Display Rejection Reason]
    M --> N[Option to Create New Rental]

    D -->|Active| O[Show Active Status]
    O --> P[Display Days Remaining]
    P --> Q[Show Return Instructions]

    D -->|Overdue| R[Show Overdue Status]
    R --> S[Display Overdue Days]
    S --> T[Contact Admin Warning]

    D -->|Completed| U[Show Completed Status]
    U --> V[Display Return Date]
    V --> W[Show Final Cost]
```

## Admin Management Flow

```mermaid
flowchart TD
    A[Admin Dashboard] --> B[View System Statistics]
    B --> C[Pending Rental Approvals]
    B --> D[Active Rentals Overview]
    B --> E[Financial Summary]

    C --> F[Review Pending Rentals]
    F --> G{Approve/Reject Decision}

    G -->|Approve| H[Update Status to Approved]
    H --> I[Send Notification to User]
    I --> J[Update Item Availability]

    G -->|Reject| K[Update Status to Rejected]
    K --> L[Add Rejection Reason]
    L --> M[Send Notification to User]

    D --> N[Monitor Active Rentals]
    N --> O[Track Return Deadlines]
    O --> P{Overdue Rentals?}
    P -->|Yes| Q[Send Overdue Notifications]
    P -->|No| R[Continue Monitoring]

    E --> S[View Income/Expense Reports]
    S --> T[Generate Financial Reports]
```

## Data Model Relationships

```mermaid
erDiagram
    User ||--o{ Rental : "has many"
    User {
        id PK
        name string
        email string
        password string
        role string
    }

    Item ||--o{ Rental : "has many"
    Item {
        id PK
        name string
        description text
        category_id FK
        condition enum
        status enum
        location string
        quantity int
        buy_price decimal
        rent_price decimal
    }

    Category ||--o{ Item : "has many"
    Category {
        id PK
        name string
        description text
    }

    Rental ||--o{ FinancialRecord : "has many"
    Rental {
        id PK
        user_id FK
        item_id FK
        start_date date
        end_date date
        total_price decimal
        status enum
        returned_at datetime
        payment_status enum
        borrower_name string
        purpose text
    }

    PhotoboothQueue ||--o{ FinancialRecord : "has many"
    PhotoboothQueue {
        id PK
        user_name string
        status enum
        queue_number int
        created_at datetime
    }

    FinancialRecord {
        id PK
        type enum
        category string
        description text
        amount decimal
        date date
        rental_id FK
        photobooth_queue_id FK
    }
```

## Key Features Summary

### User Features:
- Browse and search equipment by category
- Create rental requests (single or bulk)
- Track rental status and history
- View financial records
- Access reports and analytics
- Manage photobooth queues

### Admin Features:
- Approve/reject rental requests
- Manage equipment inventory
- Track damaged items
- Generate financial reports
- Monitor system usage
- Manage photobooth operations

### Technical Stack:
- **Frontend**: Livewire, TailwindCSS, Flux UI
- **Backend**: Laravel 12, PHP 8.x
- **Database**: PostgreSQL (Neon)
- **Authentication**: Laravel Fortify
- **Caching**: Database sessions, Redis/file cache
- **Asset Management**: Vite, Laravel Vite Plugin