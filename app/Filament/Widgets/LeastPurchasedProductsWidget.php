<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LeastPurchasedProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Sản phẩm ế (Ít mua nhất)';
    
    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->selectRaw('products.*, COALESCE((SELECT SUM(od.quantity) FROM order_details od JOIN orders o ON o.id = od.order_id WHERE od.product_id = products.id AND o.status != ?), 0) as total_sold', ['cancelled'])
                    ->orderBy('total_sold', 'asc')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->circular()
                    ->getStateUsing(function (Product $record) {
                        return $record->displayImage(100);
                    }),
                Tables\Columns\TextColumn::make('name')
                    ->label('Sản phẩm')
                    ->limit(20)
                    ->tooltip(fn ($record) => $record->name),
                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Đã bán')
                    ->badge()
                    ->color('danger'),
            ])
            ->paginated(false);
    }
}
