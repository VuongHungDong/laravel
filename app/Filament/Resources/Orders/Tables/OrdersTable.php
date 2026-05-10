<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;

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
                    ->weight('bold'),
                TextColumn::make('name')
                    ->label('Khách hàng')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('SĐT')
                    ->searchable(),
                TextColumn::make('total_price')
                    ->label('Tổng tiền')
                    ->money('VND')
                    ->sortable(),
                SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'pending' => 'Chờ xử lý',
                        'processing' => 'Đang chuẩn bị',
                        'shipped' => 'Đang giao',
                        'delivered' => 'Đã giao',
                        'cancelled' => 'Đã huỷ',
                    ])
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Ngày đặt')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
            ]);
    }
}
