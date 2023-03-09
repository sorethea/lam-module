<?php

namespace Modules\LAM\Filament\Resources\ResourceResource\Pages;

use Modules\LAM\Filament\Resources\ResourceResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResource extends CreateRecord
{
    protected static string $resource = ResourceResource::class;
}
