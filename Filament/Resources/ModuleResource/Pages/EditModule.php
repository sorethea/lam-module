<?php

namespace Modules\Lam\Filament\Resources\ModuleResource\Pages;

use Modules\Lam\Filament\Resources\ModuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
