<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LeastViewedProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Sản phẩm ít được quan tâm';
    
    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 5;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->orderBy('view', 'asc')
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
                Tables\Columns\TextColumn::make('view')
                    ->label('Lượt xem')
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-o-eye'),
            ])
            ->paginated(false);
    }
}
