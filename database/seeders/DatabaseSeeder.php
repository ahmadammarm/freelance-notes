<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks to truncate
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Client::truncate();
        \App\Models\Project::truncate();
        \App\Models\Invoice::truncate();
        \App\Models\Expense::truncate();
        \App\Models\TimeLog::truncate();
        \App\Models\RecurringInvoice::truncate();
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        // 1. Create Admin User
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        // 2. Create Clients
        $clientA = \App\Models\Client::create([
            'name' => 'Acme Corp',
            'email' => 'contact@acme.com',
            'phone' => '123456789',
            'address' => '123 Business Rd, New York',
        ]);

        $clientB = \App\Models\Client::create([
            'name' => 'Global Tech Solutions',
            'email' => 'info@globaltech.com',
            'phone' => '987654321',
            'address' => '456 Innovation Way, San Francisco',
        ]);

        // 3. Create Projects
        // Fixed Price Project
        $project1 = \App\Models\Project::create([
            'name' => 'Website Redesign',
            'client_id' => $clientA->id,
            'description' => 'A complete overhaul of the company website.',
            'billing_type' => 'fixed',
            'price' => 5000000,
            'start_date' => now()->subMonth(),
            'end_date' => now()->addMonth(),
        ]);

        // Hourly Project
        $project2 = \App\Models\Project::create([
            'name' => 'Mobile App Maintenance',
            'client_id' => $clientB->id,
            'description' => 'Ongoing bug fixes and feature updates.',
            'billing_type' => 'hourly',
            'hourly_rate' => 250000,
            'start_date' => now()->subMonths(2),
            'end_date' => now()->addMonths(4),
        ]);

        // 4. Create Invoices
        \App\Models\Invoice::create([
            'project_id' => $project1->id,
            'title' => 'Initial Deposit',
            'detail' => '50% upfront payment for website redesign.',
            'total_price' => 2500000,
            'issue_date' => now()->subWeeks(3),
            'due_date' => now()->subWeeks(2),
            'paid_date' => now()->subWeeks(2),
        ]);

        \App\Models\Invoice::create([
            'project_id' => $project1->id,
            'title' => 'Milestone 1',
            'detail' => 'Completion of design phase.',
            'total_price' => 2500000,
            'issue_date' => now()->subDays(5),
            'due_date' => now()->addDays(5),
        ]);

        // 5. Create Expenses
        \App\Models\Expense::create([
            'project_id' => $project1->id,
            'description' => 'Stock Photos',
            'amount' => 500000,
            'date' => now()->subWeeks(2),
        ]);

        \App\Models\Expense::create([
            'project_id' => $project2->id,
            'description' => 'API Subscription',
            'amount' => 150000,
            'date' => now()->subMonth(),
        ]);

        // 6. Create Time Logs
        // Billed logs
        $invoice3 = \App\Models\Invoice::create([
            'project_id' => $project2->id,
            'title' => 'Maintenance - April',
            'total_price' => 1000000, // 4 hours * 250k
            'issue_date' => now()->subMonth(),
            'due_date' => now()->subMonth()->addDays(7),
            'paid_date' => now()->subMonth()->addDays(2),
        ]);

        \App\Models\TimeLog::create([
            'project_id' => $project2->id,
            'invoice_id' => $invoice3->id,
            'description' => 'Bug fixes in login module',
            'hours' => 4,
            'date' => now()->subMonth()->subDays(5),
        ]);

        // Unbilled logs
        \App\Models\TimeLog::create([
            'project_id' => $project2->id,
            'description' => 'New feature: Dark mode',
            'hours' => 6,
            'date' => now()->subDays(2),
        ]);

        \App\Models\TimeLog::create([
            'project_id' => $project2->id,
            'description' => 'Database optimization',
            'hours' => 2.5,
            'date' => now()->subDay(),
        ]);

        // 7. Create Recurring Invoices
        \App\Models\RecurringInvoice::create([
            'project_id' => $project2->id,
            'frequency' => 'monthly',
            'amount' => 1000000,
            'next_run_date' => now()->addMonth(),
            'is_active' => true,
        ]);
    }
}
