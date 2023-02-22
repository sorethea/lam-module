<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\Core\Filament\Resources\UserResource\Pages;
use Modules\LAM\Filament\Resources\UserResource\RelationManagers\AddressesRelationManager;
use Modules\LAM\Filament\Resources\UserResource\RelationManagers\PhonesRelationManager;
use Modules\LAM\Models\User;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                        ->required(),
                    Forms\Components\TextInput::make("email")
                        ->required()
                        ->unique("users","email",ignorable: fn($record)=>$record),
                    Forms\Components\TextInput::make("password")
                        ->password()
                        ->required()
                        ->visibleOn("create")
                        ->same("password_confirmation"),
                    Forms\Components\TextInput::make("password_confirmation")
                        ->password()
                        ->visibleOn("create")
                        ->required(),
                    Forms\Components\BelongsToManyMultiSelect::make("roles")
                        ->relationship("roles","name"),
                    Forms\Components\SpatieMediaLibraryFileUpload::make("avatar")
                        ->collection('avatar')->image(),
                ])->columns(2)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make("avatar")
                    ->collection("avatar")
                    ->conversion("thumb")
                    ->rounded(),
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("phone")->searchable(),
                Tables\Columns\TextColumn::make("email")->searchable(),
                Tables\Columns\TextColumn::make("roles.name")->searchable(),
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
            PhonesRelationManager::class,
            AddressesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Modules\LAM\Filament\Resources\UserResource\Pages\ListUsers::route('/'),
            'create' => \Modules\LAM\Filament\Resources\UserResource\Pages\CreateUser::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\UserResource\Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
