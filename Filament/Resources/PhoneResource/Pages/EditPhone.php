<?php

namespace Modules\LAM\Filament\Resources\PhoneResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\LAM\Filament\Resources\PhoneResource;

class EditPhone extends EditRecord
{
    protected static string $resource = PhoneResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
