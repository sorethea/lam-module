<?php

namespace Modules\LAM\Filament\Resources\ActivityResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Modules\LAM\Filament\Resources\ActivityResource;

class ListActivities extends ListRecords
{
    protected static string $resource = ActivityResource::class;

    protected function getActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
