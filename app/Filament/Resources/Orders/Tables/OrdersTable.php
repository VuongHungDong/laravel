<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Mã ĐH')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold')
                    ->color('primary'),
                TextColumn::make('name')
                    ->label('Khách hàng')
                    ->searchable()
                    ->icon('heroicon-o-user'),
                TextColumn::make('phone')
                    ->label('SĐT')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->copyable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('address')
                    ->label('Địa chỉ')
                    ->limit(30)
                    ->tooltip(fn ($record) => $record->address)
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('total_price')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),
                TextColumn::make('details_count')
                    ->label('Số SP')
                    ->counts('details')
                    ->sortable()
                    ->badge()
                    ->color('info'),
                SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => '⏳ Chờ xử lý',
                        'processing' => '📦 Đang chuẩn bị',
                        'shipped' => '🚚 Đang giao',
                        'delivered' => '✅ Đã giao',
                        'cancelled' => '❌ Đã huỷ',
                    ])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since()
                    ->tooltip(fn ($record) => $record->created_at->format('d/m/Y H:i:s')),
                TextColumn::make('updated_at')
                    ->label('Cập nhật')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang chuẩn bị',
                        'shipped' => 'Đang giao',
                        'delivered' => 'Đã giao',
                        'cancelled' => 'Đã huỷ',
                    ])
                    ->multiple()
                    ->preload(),
                Filter::make('created_today')
                    ->label('Đơn hôm nay')
                    ->query(fn (Builder $query) => $query->whereDate('created_at', today())),
                Filter::make('created_this_week')
                    ->label('Tuần này')
                    ->query(fn (Builder $query) => $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->poll('30s'); // Tự động cập nhật mỗi 30 giây
    }
}
