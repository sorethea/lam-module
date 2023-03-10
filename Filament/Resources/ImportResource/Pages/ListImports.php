<?php

namespace Modules\LAM\Filament\Resources\ImportResource\Pages;

use Modules\LAM\Filament\Resources\ImportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImports extends ListRecords
{
    protected static string $resource = ImportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
