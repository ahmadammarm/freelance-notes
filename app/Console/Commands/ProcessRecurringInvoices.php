<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessRecurringInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:process-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process due recurring invoices and generate standard invoices.';

    /**
     * Execute the console command.
     */
    public function handle(BillingService $billingService)
    {
        $this->info('Processing recurring invoices...');
        $billingService->processRecurringInvoices();
        $this->info('Recurring invoices processed successfully.');
    }
}
