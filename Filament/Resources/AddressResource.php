<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Address;
use Modules\Utility\Filament\Resources\AddressResource\Pages;
use Modules\Utility\Filament\Resources\AddressResource\RelationManagers;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static function getNavigationIcon(): string
    {
        return config('lam.models.Address.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('lam.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("address")->searchable(),
                Tables\Columns\TextColumn::make("owner_id")->searchable(),
                Tables\Columns\TextColumn::make("owner_type")->searchable(),
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
            'index' => \Modules\LAM\Filament\Resources\AddressResource\Pages\ListAddresses::route('/'),
            'create' => \Modules\LAM\Filament\Resources\AddressResource\Pages\CreateAddress::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\AddressResource\Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
