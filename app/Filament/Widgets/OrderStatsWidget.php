<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $processingOrders = Order::where('status', 'processing')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_price');
        $todayOrders = Order::whereDate('created_at', today())->count();
        $todayRevenue = Order::whereDate('created_at', today())->where('status', '!=', 'cancelled')->sum('total_price');

        return [
            Stat::make('Tổng đơn hàng', $totalOrders)
                ->description("Hôm nay: {$todayOrders} đơn")
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            Stat::make('Chờ xử lý', $pendingOrders)
                ->description('Cần xử lý ngay')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Đang giao', $shippedOrders)
                ->description("Đang chuẩn bị: {$processingOrders}")
                ->descriptionIcon('heroicon-o-truck')
                ->color('info'),
            Stat::make('Doanh thu', number_format($totalRevenue) . ' ₫')
                ->description('Hôm nay: ' . number_format($todayRevenue) . ' ₫')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success')
                ->chart([3, 5, 7, 4, 6, 8, 5]),
        ];
    }
}
