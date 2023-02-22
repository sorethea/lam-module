<?php

namespace Modules\LAM\Filament\Resources\PriceResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\LAM\Filament\Resources\PriceResource;

class EditPrice extends EditRecord
{
    protected static string $resource = PriceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
