<?php

namespace Modules\LAM\Filament\Resources\PhoneResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\LAM\Filament\Resources\PhoneResource;

class ListPhones extends ListRecords
{
    protected static string $resource = PhoneResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
