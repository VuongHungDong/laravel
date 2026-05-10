<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopCustomersWidget extends BaseWidget
{
    protected static ?string $heading = 'Khách hàng chi tiêu nhiều nhất';
    
    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 6;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->select('name', 'email', 'phone', DB::raw('MAX(id) as id'), DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_price) as total_spent'))
                    ->where('status', '!=', 'cancelled')
                    ->whereNotNull('email')
                    ->groupBy('name', 'email', 'phone')
                    ->orderByRaw('SUM(total_price) DESC')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Khách hàng')
                    ->description(fn (Order $record): string => $record->phone ?? '')
                    ->icon('heroicon-o-user')
                    ->limit(20)
                    ->tooltip(fn ($record) => $record->email),
                Tables\Columns\TextColumn::make('total_orders')
                    ->label('Số đơn')
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('total_spent')
                    ->label('Tổng chi')
                    ->money('VND')
                    ->weight('bold')
                    ->color('success'),
            ])
            ->paginated(false);
    }
}
