<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\Core\Filament\Resources\RoleResource\Pages;
use Modules\LAM\Filament\Resources\RoleResource\RelationManagers\PermissionsRelationManager;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static function getNavigationGroup(): ?string
    {
        return config('lam.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique("roles","name",fn($record)=>$record)
                        ->required(),
                ])->columnSpan(2)
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("created_at")->since(),
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
            PermissionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\LAM\Filament\Resources\RoleResource\Pages\ListRoles::route('/'),
            'create' => \Modules\LAM\Filament\Resources\RoleResource\Pages\CreateRole::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\RoleResource\Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
