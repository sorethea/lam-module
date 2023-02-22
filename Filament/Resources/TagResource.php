<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Tag;
use Modules\Utility\Filament\Resources\TagResource\Pages;
use Modules\Utility\Filament\Resources\TagResource\RelationManagers;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static function getNavigationIcon(): string
    {
        return config('lam.models.Tag.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('utility.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique("tags", "name", fn($record)=>$record)
                        ->required(),
                    Forms\Components\TextInput::make("slug")->nullable(),
                    Forms\Components\TextInput::make("model"),
                    Forms\Components\Toggle::make('active')->default(true),
                ])->columns(2)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("slug")->searchable(),
                Tables\Columns\TextColumn::make("model")->searchable(),
                Tables\Columns\ToggleColumn::make("active"),
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
            'index' => \Modules\LAM\Filament\Resources\TagResource\Pages\ListTags::route('/'),
            'create' => \Modules\LAM\Filament\Resources\TagResource\Pages\CreateTag::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\TagResource\Pages\EditTag::route('/{record}/edit'),
        ];
    }
}
