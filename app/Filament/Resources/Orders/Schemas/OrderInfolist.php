<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Thông tin đơn hàng
                Section::make('Thông tin đơn hàng')
                    ->icon('heroicon-o-shopping-bag')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('code')
                                ->label('Mã đơn hàng')
                                ->weight('bold')
                                ->size('lg')
                                ->copyable()
                                ->color('primary'),
                            TextEntry::make('status')
                                ->label('Trạng thái')
                                ->badge()
                                ->formatStateUsing(fn (string $state): string => match($state) {
                                    'pending' => '⏳ Chờ xử lý',
                                    'processing' => '📦 Đang chuẩn bị',
                                    'shipped' => '🚚 Đang giao',
                                    'delivered' => '✅ Đã giao',
                                    'cancelled' => '❌ Đã huỷ',
                                    default => $state,
                                })
                                ->color(fn (string $state): string => match($state) {
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'gray',
                                }),
                            TextEntry::make('total_price')
                                ->label('Tổng tiền')
                                ->money('VND')
                                ->weight('bold')
                                ->size('lg')
                                ->color('success'),
                        ]),
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->label('Ngày đặt hàng')
                                ->dateTime('d/m/Y H:i:s')
                                ->icon('heroicon-o-calendar'),
                            TextEntry::make('updated_at')
                                ->label('Cập nhật lần cuối')
                                ->dateTime('d/m/Y H:i:s')
                                ->icon('heroicon-o-clock'),
                        ]),
                    ]),

                // Thông tin khách hàng
                Section::make('Thông tin khách hàng')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Họ và tên')
                                ->icon('heroicon-o-user-circle')
                                ->placeholder('Không có'),
                            TextEntry::make('email')
                                ->label('Email')
                                ->icon('heroicon-o-envelope')
                                ->copyable()
                                ->placeholder('Không có'),
                            TextEntry::make('phone')
                                ->label('Số điện thoại')
                                ->icon('heroicon-o-phone')
                                ->copyable()
                                ->placeholder('Không có'),
                            TextEntry::make('user_id')
                                ->label('Mã tài khoản')
                                ->icon('heroicon-o-identification')
                                ->placeholder('Khách vãng lai'),
                        ]),
                        TextEntry::make('address')
                            ->label('Địa chỉ giao hàng')
                            ->icon('heroicon-o-map-pin')
                            ->columnSpanFull()
                            ->placeholder('Không có'),
                    ])
                    ->collapsible(),

                // Chi tiết sản phẩm
                Section::make('Sản phẩm đã đặt')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        RepeatableEntry::make('details')
                            ->label('')
                            ->schema([
                                Grid::make(4)->schema([
                                    TextEntry::make('product.name')
                                        ->label('Tên sản phẩm')
                                        ->weight('bold'),
                                    TextEntry::make('price')
                                        ->label('Đơn giá')
                                        ->money('VND'),
                                    TextEntry::make('quantity')
                                        ->label('Số lượng')
                                        ->numeric(),
                                    TextEntry::make('total_line')
                                        ->label('Thành tiền')
                                        ->money('VND')
                                        ->state(fn ($record) => $record->price * $record->quantity)
                                        ->weight('bold')
                                        ->color('success'),
                                ]),
                            ]),
                    ])
                    ->collapsible(),
            ]);
    }
}
