<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Price;
use Modules\LAM\Models\Tag;
use Modules\Utility\Filament\Resources\PriceResource\Pages;
use Modules\Utility\Filament\Resources\PriceResource\RelationManagers;

class PriceResource extends Resource
{
    protected static ?string $model = Price::class;

    protected static function getNavigationIcon(): string
    {
        return config('utility.models.Price.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('utility.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make("price")
                    ->required(),
                Forms\Components\Select::make("tag")
                    ->options(fn()=>Tag::where("model","Price")->pluck("name","id"))
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\LAM\Filament\Resources\PriceResource\Pages\ListPrices::route('/'),
            'create' => \Modules\LAM\Filament\Resources\PriceResource\Pages\CreatePrice::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\PriceResource\Pages\EditPrice::route('/{record}/edit'),
        ];
    }
}
