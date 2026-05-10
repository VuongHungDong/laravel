<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Order;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class AnalyticsWidget extends Widget
{
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.analytics-widget';

    public function getViewData(): array
    {
        // Top 5 sản phẩm bán chạy nhất
        $topProducts = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.id', '=', 'order_details.order_id')
                     ->where('orders.status', '!=', 'cancelled');
            })
            ->select('products.id', 'products.name', 'products.image', DB::raw('COALESCE(SUM(order_details.quantity), 0) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // Top 5 khách hàng chi tiêu nhiều nhất
        $topCustomers = DB::table('orders')
            ->select('name', 'email', 'phone', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_spent'))
            ->where('status', '!=', 'cancelled')
            ->whereNotNull('email')
            ->groupBy('name', 'email', 'phone')
            ->orderByDesc('total_spent')
            ->limit(5)
            ->get();

        // Top 5 sản phẩm ít bán nhất
        $leastSoldProducts = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.id', '=', 'order_details.order_id')
                     ->where('orders.status', '!=', 'cancelled');
            })
            ->select('products.id', 'products.name', 'products.image', DB::raw('COALESCE(SUM(order_details.quantity), 0) as total_sold'))
            ->groupBy('products.id', 'products.name', 'products.image')
            ->orderBy('total_sold')
            ->limit(5)
            ->get();

        // Top 5 sản phẩm ít lượt xem nhất
        $leastViewedProducts = DB::table('products')
            ->select('id', 'name', 'image', 'view')
            ->orderBy('view')
            ->limit(5)
            ->get();

        return [
            'topProducts'        => $topProducts,
            'topCustomers'       => $topCustomers,
            'leastSoldProducts'  => $leastSoldProducts,
            'leastViewedProducts'=> $leastViewedProducts,
        ];
    }
}
