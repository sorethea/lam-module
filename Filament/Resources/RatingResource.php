<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Rating;
use Modules\Utility\Filament\Resources\RatingResource\Pages;
use Modules\Utility\Filament\Resources\RatingResource\RelationManagers;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static function getNavigationIcon(): string
    {
        return config('utility.models.Rating.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('utility.navigation.name');
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
            'index' => \Modules\LAM\Filament\Resources\RatingResource\Pages\ListRatings::route('/'),
            'create' => \Modules\LAM\Filament\Resources\RatingResource\Pages\CreateRating::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\RatingResource\Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
