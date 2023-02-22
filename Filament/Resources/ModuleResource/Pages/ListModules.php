<?php

namespace Modules\LAM\Filament\Resources\ModuleResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Modules\Core\Models\Module;
use Modules\LAM\Filament\Resources\ModuleResource;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('scan_modules')
                ->button()
                ->icon('heroicon-o-search')
                ->action(function (){
                    \lam::scan();
                    redirect(request()->header("Referer"));
                })
        ];
    }
}
