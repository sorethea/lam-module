<?php

namespace Modules\LAM\Filament\Resources\AddressResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\LAM\Filament\Resources\AddressResource;

class ListAddresses extends ListRecords
{
    protected static string $resource = AddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
