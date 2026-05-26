<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Support\Facades\DB;

class FinancialService
{
    public function getDashboardStats(): array
    {
        $totalRevenue = Invoice::whereNotNull('paid_date')->sum('total_price');
        $pendingPayments = Invoice::whereNull('paid_date')->sum('total_price');
        $totalExpenses = Expense::sum('amount');

        return [
            'total_revenue' => $totalRevenue,
            'pending_payments' => $pendingPayments,
            'total_expenses' => $totalExpenses,
            'net_profit' => $totalRevenue - $totalExpenses,
        ];
    }

    public function calculateProjectProfitability(Project $project): array
    {
        $revenue = $project->invoices()->whereNotNull('paid_date')->sum('total_price');
        $expenses = $project->expenses()->sum('amount');

        return [
            'revenue' => $revenue,
            'expenses' => $expenses,
            'profit' => $revenue - $expenses,
        ];
    }

    public function getRevenueTrend(): array
    {
        $data = Invoice::whereNotNull('paid_date')
            ->whereYear('paid_date', now()->year)
            ->selectRaw('MONTH(paid_date) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->all();

        return $this->fillMissingMonths($data);
    }

    public function getExpenseTrend(): array
    {
        $data = Expense::whereYear('date', now()->year)
            ->selectRaw('MONTH(date) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->all();

        return $this->fillMissingMonths($data);
    }

    protected function fillMissingMonths(array $data): array
    {
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $data[$i] ?? 0;
        }
        return $months;
    }
}
