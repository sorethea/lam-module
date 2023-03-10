<?php

namespace Modules\LAM\Filament\Resources\ImportResource\Pages;

use Modules\LAM\Filament\Resources\ImportResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImport extends EditRecord
{
    protected static string $resource = ImportResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
