<?php

namespace Modules\LAM\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Modules\Lam\Filament\Resources\ModuleResource;
use Spatie\LaravelPackageTools\Package;

class FilamentServiceProvider extends PluginServiceProvider
{
    public function isEnabled(): bool{
        $module = \Module::find('lam');
        return $module->isEnabled();
    }
    protected array $pages = [];
    protected array $resources =[
        ModuleResource::class,
    ];
    public function configurePackage(Package $package): void
    {
        $package->name('lam');
    }

    public function getResources(): array
    {
        return ($this->isEnabled())?$this->resources:[];
    }

    public function getPages(): array
    {
        return ($this->isEnabled())?$this->pages:[];
    }

    public function boot()
    {
        Filament::serving(function (){
            if(config('lam.navigation.enabled'))
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                    ->label(config('lam.navigation.name'))
            ]);
        });
        return parent::boot();
    }
}
