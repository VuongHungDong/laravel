<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description'),
                \Filament\Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->collection('product-images')
                    ->image()
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                \Filament\Forms\Components\Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
            ]);
    }
}
