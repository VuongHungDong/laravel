<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;

class TopCustomersWidget extends Widget
{
    protected static string $view = 'filament.widgets.top-customers-widget';
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 6;

    public $customers = [];

    public function mount()
    {
        try {
            $this->customers = DB::table('orders')
                ->select('name', 'email', 'phone', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_spent'))
                ->where('status', '!=', 'cancelled')
                ->whereNotNull('email')
                ->groupBy('name', 'email', 'phone')
                ->orderByRaw('SUM(total_price) DESC')
                ->limit(5)
                ->get()
                ->toArray();
        } catch (\Throwable $e) {
            $this->customers = [];
        }
    }
}
