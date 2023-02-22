<?php

namespace Modules\LAM\Filament\Resources\AddressResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\LAM\Filament\Resources\AddressResource;

class EditAddress extends EditRecord
{
    protected static string $resource = AddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
