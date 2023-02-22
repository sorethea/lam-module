<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Modules\Core\Filament\Resources\ActivityResource\Pages;
use Modules\Core\Filament\Resources\ActivityResource\RelationManagers;
use Modules\Core\Tables\Columns\PopOver;
use Spatie\Activitylog\Models\Activity;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static function getNavigationGroup(): ?string
    {
        return config('lam.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("description"),
                    Forms\Components\TextInput::make("event"),
                    Forms\Components\BelongsToSelect::make("causer")
                        ->relationship("causer","name"),
                    Forms\Components\BelongsToSelect::make("subject")
                        ->relationship("subject","name"),
                    Forms\Components\KeyValue::make("properties.attributes")
                        ->label("Attributes")
                        ->keyLabel("Column")
                        ->valueLabel("Value"),
                    Forms\Components\KeyValue::make("properties.old")
                        ->label("Old")
                        ->keyLabel("Column")
                        ->valueLabel("Value"),
                    Forms\Components\DateTimePicker::make("created_at"),
                ])
                    ->columns(2)
                    ->columnSpan(2),

            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("description")
                    ->searchable(),
                Tables\Columns\TextColumn::make("event")
                    ->searchable(),
                Tables\Columns\TextColumn::make("causer.name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("subject.name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("created_at")->since(),
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
            'index' => \Modules\LAM\Filament\Resources\ActivityResource\Pages\ListActivities::route('/'),
//            'create' => Pages\CreateActivity::route('/create'),
//            'edit' => Pages\EditActivity::route('/{record}/edit'),
            'view' => \Modules\LAM\Filament\Resources\ActivityResource\Pages\ViewActivity::route('/{record}'),
        ];
    }
}
