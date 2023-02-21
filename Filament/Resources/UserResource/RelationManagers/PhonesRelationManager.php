<?php

namespace Modules\LAM\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;

class PhonesRelationManager extends RelationManager
{
    protected static string $relationship = 'phones';

    protected static ?string $recordTitleAttribute = 'phone_number';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('phone_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('remark')
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_default'),
            ]);
    }

    public function defaultPhone($record){

    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('phone_number')->searchable(),
                Tables\Columns\TextColumn::make("remark"),
                //Tables\Columns\ToggleColumn::make('is_default'),
                Tables\Columns\BooleanColumn::make("is_default"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
