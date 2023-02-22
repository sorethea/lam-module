<?php

namespace Modules\LAM\Filament\Resources\RatingResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\LAM\Filament\Resources\RatingResource;

class EditRating extends EditRecord
{
    protected static string $resource = RatingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
