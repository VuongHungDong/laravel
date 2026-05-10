<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    protected static ?string $title = 'Sản phẩm đã đặt';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Sản phẩm')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('quantity')
                    ->label('Số lượng')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->label('Đơn giá')
                    ->required()
                    ->numeric()
                    ->suffix('VNĐ'),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('product.name')
                    ->label('Sản phẩm'),
                TextEntry::make('quantity')
                    ->label('Số lượng')
                    ->numeric(),
                TextEntry::make('price')
                    ->label('Đơn giá')
                    ->money('VND'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product.name')
            ->columns([
                TextColumn::make('product.name')
                    ->label('Sản phẩm')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Đơn giá')
                    ->money('VND')
                    ->sortable(),
                TextColumn::make('quantity')
                    ->label('Số lượng')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Thành tiền')
                    ->money('VND')
                    ->state(function ($record) {
                        return $record->price * $record->quantity;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
