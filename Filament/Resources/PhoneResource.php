<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Phone;
use Modules\Utility\Filament\Resources\PhoneResource\Pages;
use Modules\Utility\Filament\Resources\PhoneResource\RelationManagers;

class PhoneResource extends Resource
{
    protected static ?string $model = Phone::class;

    protected static function getNavigationIcon(): string
    {
        return config('lam.models.Phone.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('lam.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("phone_number")->searchable(),
                Tables\Columns\TextColumn::make("owner_id")->searchable(),
                Tables\Columns\TextColumn::make("owner_type")->searchable(),
                //Tables\Columns\BooleanColumn::make("is_default")
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => \Modules\LAM\Filament\Resources\PhoneResource\Pages\ListPhones::route('/'),
            //'create' => Pages\CreatePhone::route('/create'),
            //'edit' => Pages\EditPhone::route('/{record}/edit'),
        ];
    }
}
