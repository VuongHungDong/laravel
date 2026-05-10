<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class OrderChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Đơn hàng 7 ngày gần nhất';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(function ($daysAgo) {
            return Carbon::now()->subDays($daysAgo);
        });

        $labels = $days->map(fn ($date) => $date->format('d/m'))->toArray();
        
        $orderData = $days->map(function ($date) {
            return Order::whereDate('created_at', $date)->count();
        })->toArray();

        $revenueData = $days->map(function ($date) {
            return Order::whereDate('created_at', $date)
                ->where('status', '!=', 'cancelled')
                ->sum('total_price') / 1000; // Chia 1000 để hiển thị đẹp (đơn vị: nghìn đồng)
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Số đơn hàng',
                    'data' => $orderData,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                ],
                [
                    'label' => 'Doanh thu (nghìn ₫)',
                    'data' => $revenueData,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
