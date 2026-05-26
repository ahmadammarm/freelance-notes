# Freelance Notes

Freelance Notes is a comprehensive management system built with Laravel and Filament, designed specifically for freelancers to streamline client management, project tracking, and financial automation.

## Project Overview

This application serves as a centralized hub for managing a freelance business. It provides a robust administrative interface for tracking work progress, logging billable hours, managing business expenses, and automating the invoicing process.

## Core Features

### 1. Client and Project Management
*   Maintain a detailed database of clients with contact information and history.
*   Organize work into distinct projects with specific timelines and descriptions.
*   Support for both fixed-price projects and hourly-rate engagements.

### 2. Financial Tracking
*   **Time Logging:** Record hours worked on specific tasks within projects for accurate hourly billing.
*   **Expense Management:** Track project-specific or general business costs to calculate true profitability.
*   **Revenue Analytics:** Real-time dashboard visualizations showing monthly revenue trends and pending payments.

### 3. Automated Invoicing
*   **Manual Invoicing:** Generate professional invoices for fixed milestones.
*   **Hourly Invoicing:** Automatically aggregate unbilled time logs into formatted invoices with a single click.
*   **Recurring Invoices:** Set up automated billing cycles (weekly, monthly, yearly) for retainer-based clients.
*   **PDF Generation:** Preview and download professionally formatted PDF invoices for distribution to clients.

### 4. Advanced User Experience
*   **Single Page Application (SPA):** Instant navigation between all resources without full page reloads.
*   **Modern Admin Interface:** Powered by Filament 3, providing a responsive and secure management environment.

## Technical Stack

*   **Backend:** PHP 8.1+ / Laravel 10
*   **Admin Panel:** Filament 3.2 (TALL Stack)
*   **Database:** MySQL
*   **PDF Engine:** Barryvdh Laravel DomPDF
*   **Frontend Tooling:** Vite

## Installation and Setup

### Prerequisites
*   PHP 8.1 or higher
*   Composer
*   Node.js and NPM
*   MySQL

### Setup Steps

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/ahmadammarm/freelance-notes.git
    cd freelance-notes
    ```

2.  **Install dependencies:**
    ```bash
    composer install
    npm install
    ```

3.  **Environment configuration:**
    *   Copy the example environment file: `cp .env.example .env`
    *   Configure your database settings in the `.env` file.
    *   Generate the application key: `php artisan key:generate`

4.  **Run migrations and seed data:**
    ```bash
    php artisan migrate --seed
    ```

5.  **Compile assets:**
    ```bash
    npm run build
    ```

6.  **Run the application:**
    ```bash
    php artisan serve
    ```

## Authentication

The default administrative dashboard is accessible at `/admin`.

If you used the seeder during installation, you can log in with:
*   **Email:** admin@example.com
*   **Password:** password

To create a new administrative user:
```bash
php artisan make:filament-user
```

## Automated Tasks

To process recurring invoices automatically, ensure the Laravel scheduler is running or execute the following command manually:
```bash
php artisan invoices:process-recurring
```

## Contributing

Contributions to Freelance Notes are welcome. Please ensure that any pull requests maintain the established coding standards (Laravel Pint) and include relevant tests where applicable.
