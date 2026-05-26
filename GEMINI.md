# Gemini CLI - Freelance Notes

This project is a freelance management system built with Laravel and Filament. It allows users to manage clients, projects, and generate/download invoices as PDFs.

## Project Overview

*   **Type:** Laravel Web Application
*   **Core Stack:** PHP 8.1, Laravel 10, MySQL, Filament 3.2 (TALL stack admin panel)
*   **Key Libraries:** 
    *   `filament/filament`: Admin panel framework.
    *   `barryvdh/laravel-dompdf`: PDF generation for invoices.
*   **Architecture:** Standard Laravel MVC. Filament resources are located in `app/Filament/Resources`.

## Building and Running

### Prerequisites
*   PHP 8.1+
*   Composer
*   Node.js & NPM
*   MySQL

### Setup Commands
1.  **Clone and Install Dependencies:**
    ```bash
    composer install
    npm install
    ```
2.  **Environment Configuration:**
    *   Copy `.env.example` to `.env` and configure your database settings.
    *   `php artisan key:generate`
3.  **Database Migration:**
    ```bash
    php artisan migrate
    ```
4.  **Create Admin User:**
    ```bash
    php artisan make:filament-user
    ```
5.  **Run Development Server:**
    ```bash
    php artisan serve
    # In another terminal
    npm run dev
    ```

## Development Conventions

*   **Code Style:** This project uses [Laravel Pint](https://laravel.com/docs/10.x/pint). Run `./vendor/bin/pint` to fix styling issues.
*   **Testing:** [PHPUnit](https://phpunit.de/) is configured. Run tests with `php artisan test` or `./vendor/bin/phpunit`.
*   **Filament Resources:** Admin interface logic is encapsulated in `app/Filament/Resources`. When adding new features to the admin panel, start there.
*   **Invoices:** Invoice generation logic is handled by `App\Http\Controllers\InvoiceController` and uses the `resources/views/invoice/index.blade.php` template for PDF generation.

## Key Files & Directories

*   `app/Models/`: Eloquent models (`Client`, `Project`, `Invoice`, `User`).
*   `app/Filament/Resources/`: Filament resource classes for managing models in the admin panel.
*   `app/Http/Controllers/InvoiceController.php`: Handles invoice preview and PDF download.
*   `database/migrations/`: Database schema definitions.
*   `resources/views/invoice/index.blade.php`: The Blade template used for invoice layout.
*   `routes/web.php`: Defines routes for invoice preview and download.
