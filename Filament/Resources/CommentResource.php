<?php

namespace Modules\LAM\Filament\Resources;

use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Modules\LAM\Models\Comment;
use Modules\Utility\Filament\Resources\CommentResource\Pages;
use Modules\Utility\Filament\Resources\CommentResource\RelationManagers;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    //protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static function getNavigationIcon(): string
    {
        return config('lam.models.Comment.icon');
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
            'index' => \Modules\LAM\Filament\Resources\CommentResource\Pages\ListComments::route('/'),
            'create' => \Modules\LAM\Filament\Resources\CommentResource\Pages\CreateComment::route('/create'),
            'edit' => \Modules\LAM\Filament\Resources\CommentResource\Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
