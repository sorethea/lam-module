<?php

namespace Modules\LAM\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\PluginServiceProvider;
use Modules\LAM\Filament\Resources\AddressResource;
use Modules\LAM\Filament\Resources\CommentResource;
use Modules\Lam\Filament\Resources\ModuleResource;
use Modules\LAM\Filament\Resources\PhoneResource;
use Modules\LAM\Filament\Resources\PriceResource;
use Modules\LAM\Filament\Resources\RatingResource;
use Modules\LAM\Filament\Resources\TagResource;
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
        AddressResource::class,
        CommentResource::class,
        PhoneResource::class,
        PriceResource::class,
        RatingResource::class,
        TagResource::class,
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
