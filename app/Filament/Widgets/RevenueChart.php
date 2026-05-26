<?php

namespace App\Filament\Widgets;

use App\Services\FinancialService;
use Filament\Widgets\ChartWidget;

class RevenueChart extends ChartWidget
{
    protected static ?string $heading = 'Revenue Trend (Current Year)';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $financialService = app(FinancialService::class);
        $data = $financialService->getRevenueTrend();

        return [
            'datasets' => [
                [
                    'label' => 'Revenue',
                    'data' => $data,
                    'fill' => 'start',
                    'borderColor' => '#10b981', // green-500
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
