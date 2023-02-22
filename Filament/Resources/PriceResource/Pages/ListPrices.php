<?php

namespace Modules\LAM\Filament\Resources\PriceResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\LAM\Filament\Resources\PriceResource;

class ListPrices extends ListRecords
{
    protected static string $resource = PriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
