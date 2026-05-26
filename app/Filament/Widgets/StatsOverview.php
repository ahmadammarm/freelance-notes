<?php

namespace App\Filament\Widgets;

use App\Services\FinancialService;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $financialService = app(FinancialService::class);
        $stats = $financialService->getDashboardStats();

        return [
            Stat::make('Total Revenue', 'IDR ' . number_format($stats['total_revenue'], 0, ',', '.'))
                ->description('Total paid invoices')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Pending Payments', 'IDR ' . number_format($stats['pending_payments'], 0, ',', '.'))
                ->description('Unpaid invoices')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Net Profit', 'IDR ' . number_format($stats['net_profit'], 0, ',', '.'))
                ->description('Revenue minus expenses')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('primary'),
        ];
    }
}
