<?php

namespace App\Services;

use App\Models\Project;
use App\Models\Invoice;
use App\Models\RecurringInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BillingService
{
    public function generateInvoiceFromTimeLogs(Project $project): ?Invoice
    {
        return DB::transaction(function () use ($project) {
            $unbilledLogs = $project->timeLogs()->whereNull('invoice_id')->get();

            if ($unbilledLogs->isEmpty()) {
                return null;
            }

            $totalHours = $unbilledLogs->sum('hours');
            $totalPrice = $totalHours * ($project->hourly_rate ?? 0);

            $invoice = Invoice::create([
                'project_id' => $project->id,
                'title' => 'Invoice for Hourly Work - ' . Carbon::now()->format('M Y'),
                'detail' => "Billed hours: {$totalHours} hours at IDR " . number_format($project->hourly_rate, 0, ',', '.') . "/hr",
                'total_price' => $totalPrice,
                'issue_date' => Carbon::now(),
                'due_date' => Carbon::now()->addDays(7),
            ]);

            foreach ($unbilledLogs as $log) {
                $log->update(['invoice_id' => $invoice->id]);
            }

            return $invoice;
        });
    }

    public function processRecurringInvoices()
    {
        $dueRecurring = RecurringInvoice::where('is_active', true)
            ->where('next_run_date', '<=', Carbon::today())
            ->get();

        foreach ($dueRecurring as $recurring) {
            DB::transaction(function () use ($recurring) {
                Invoice::create([
                    'project_id' => $recurring->project_id,
                    'title' => 'Recurring Invoice - ' . Carbon::now()->format('M Y'),
                    'total_price' => $recurring->amount,
                    'issue_date' => Carbon::now(),
                    'due_date' => Carbon::now()->addDays(7),
                ]);

                $recurring->update([
                    'next_run_date' => $this->calculateNextRunDate($recurring->frequency, $recurring->next_run_date),
                ]);
            });
        }
    }

    protected function calculateNextRunDate(string $frequency, Carbon $currentDate): Carbon
    {
        return match ($frequency) {
            'weekly' => $currentDate->addWeek(),
            'monthly' => $currentDate->addMonth(),
            'yearly' => $currentDate->addYear(),
        };
    }
}
