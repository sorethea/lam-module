<?php

namespace Modules\LAM\Filament\Resources;

use Modules\LAM\Filament\Resources\ImportResource\Pages;
use Modules\LAM\Filament\Resources\ImportResource\RelationManagers;
use Modules\LAM\Models\Import;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImportResource extends Resource
{
    protected static ?string $model = Import::class;

    protected static function getNavigationIcon(): string
    {
        return config('lam.models.Import.icon');
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
            'index' => Pages\ListImports::route('/'),
            'create' => Pages\CreateImport::route('/create'),
            'edit' => Pages\EditImport::route('/{record}/edit'),
        ];
    }
}
