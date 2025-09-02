# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Technology Stack

This is a Laravel 11 web application focused on logistics and order fulfillment services. The application uses:

- **Backend**: PHP 8.2+ with Laravel 11.31
- **Frontend**: Vite build system, TailwindCSS, AlpineJS
- **Database**: SQLite (configured by default)
- **Testing**: Pest PHP testing framework
- **Payment Integration**: M-Pesa API (Kenya mobile payments)
- **Additional Features**: Laravel Breeze for authentication, Spatie Sitemap for SEO, Concurrently for dev processes

## Development Commands

### Starting Development Environment
```bash
# Start all development services (server, queue, logs, vite)
composer run dev
```

### Individual Commands
```bash
# Start Laravel development server
php artisan serve

# Start Vite development server (for frontend assets)
npm run dev

# Build production assets
npm run build

# Run queue worker
php artisan queue:listen --tries=1

# View application logs in real-time
php artisan pail --timeout=0
```

### Testing
```bash
# Run all tests with Pest
./vendor/bin/pest

# Run specific test suites
./vendor/bin/pest tests/Unit
./vendor/bin/pest tests/Feature
```

### Code Quality
```bash
# Format code with Laravel Pint
./vendor/bin/pint

# Install dependencies
composer install
npm install
```

### Database Operations
```bash
# Run migrations
php artisan migrate

# Seed database
php artisan db:seed

# Create new migration
php artisan make:migration create_table_name

# Create model with migration
php artisan make:model ModelName -m
```

## Application Architecture

### Core Business Domain
This application serves logistics and fulfillment operations across East Africa (Kenya, Tanzania, Uganda), providing:

- **Order Management**: Full-lifecycle order processing with API integration
- **Trucking Services**: Shipment tracking and delivery management
- **Payment Processing**: M-Pesa integration for mobile payments
- **Multi-tenant Admin System**: Role-based access with admin/user separation

### Key Models & Controllers
- **Order/OrderController**: API-driven order management system with status tracking
- **Trucking/TruckingController**: Physical delivery and tracking system
- **User Management**: Role-based access (admin/user) with API key authentication
- **Payment Integration**: TruckingPaymentController with M-Pesa callbacks
- **Services**: DistanceCalculatorService for shipping rate calculations
- **Middleware**: Custom API authentication, role-based access control

### Authentication & Authorization
- Uses Laravel Breeze for basic authentication
- Role-based middleware: `role:admin`, `role:admin_access`, `role:user`
- API authentication via API keys (X-API-Key header or Bearer token)
- Email verification required for protected routes

### API Architecture
- RESTful API at `/api/v1/*` with API key authentication
- Public tracking endpoint for customer order tracking
- Webhook support for external integrations
- Comprehensive API documentation at `/api/docs`

### Frontend Structure
- Server-rendered Blade templates with Alpine.js for interactivity
- TailwindCSS for styling with custom forms plugin
- Vite for modern asset bundling and HMR
- Multi-country service pages (Kenya, Tanzania, Uganda)

### Key Features
- **Blog System**: Content management with comments
- **Quote Requests**: Lead generation system
- **Email Notifications**: Automated customer communications
- **SEO Optimization**: Automated sitemap generation
- **Multi-country Support**: Localized service offerings

## Important File Locations

- **Routes**: `routes/web.php` (main application), `routes/api.php` (API endpoints)
- **Models**: `app/Models/` (Order, User, Trucking, etc.)
- **Controllers**: `app/Http/Controllers/` (organized by feature)
- **Migrations**: `database/migrations/` (database schema)
- **Views**: `resources/views/` (Blade templates)
- **Config**: Standard Laravel config in `config/`

## Development Notes

- The application uses SQLite by default - check `database/database.sqlite`
- Admin seeder available at `database/seeders/AdminSeeder.php`
- Payment integration requires M-Pesa API credentials in environment
- Multi-country routing uses consistent URL patterns: `/service/country`
- API keys are managed through both user and admin interfaces
- Queue system configured for database (background job processing)
- Rate calculation system supports city-to-city distance pricing with delivery type multipliers

## Shipping Rate Calculation
- **Within Nairobi**: Flat rate of 415 KSH regardless of weight
- **Nationwide**: Base 100 KSH + (10 KSH × weight) + (3 KSH × distance)
- **Delivery Type Multipliers**: Standard (1.0x), Express (1.5x), Same Day (2.0x)
- **Supported Currencies**: KES, TZS, UGX, USD