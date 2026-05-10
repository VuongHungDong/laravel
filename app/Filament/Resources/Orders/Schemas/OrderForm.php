<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin khách hàng')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Họ và tên')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->email(),
                            TextInput::make('phone')
                                ->label('Số điện thoại')
                                ->tel()
                                ->required(),
                            TextInput::make('user_id')
                                ->label('Tài khoản ID')
                                ->numeric(),
                        ]),
                        Textarea::make('address')
                            ->label('Địa chỉ giao hàng')
                            ->required()
                            ->columnSpanFull(),
                    ])->collapsible(),

                Section::make('Thông tin đơn hàng')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('code')
                                ->label('Mã đơn hàng')
                                ->required()
                                ->disabled()
                                ->dehydrated(),
                            Select::make('status')
                                ->label('Trạng thái')
                                ->options([
                                    'pending' => 'Chờ xử lý',
                                    'processing' => 'Đang chuẩn bị',
                                    'shipped' => 'Đang giao',
                                    'delivered' => 'Đã giao',
                                    'cancelled' => 'Đã huỷ',
                                ])
                                ->required()
                                ->native(false),
                            TextInput::make('total_price')
                                ->label('Tổng tiền')
                                ->numeric()
                                ->suffix('VNĐ')
                                ->disabled()
                                ->dehydrated(),
                        ]),
                    ])->collapsible(),
            ]);
    }
}
