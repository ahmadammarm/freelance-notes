<?php

namespace App\Filament\Widgets;

use App\Services\FinancialService;
use Filament\Widgets\ChartWidget;

class ExpenseChart extends ChartWidget
{
    protected static ?string $heading = 'Expense Trend (Current Year)';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $financialService = app(FinancialService::class);
        $data = $financialService->getExpenseTrend();

        return [
            'datasets' => [
                [
                    'label' => 'Expenses',
                    'data' => $data,
                    'backgroundColor' => '#f43f5e', // rose-500
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
