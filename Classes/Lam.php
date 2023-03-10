<?php

namespace Modules\LAM\Classes;

use Filament\Facades\Filament;
use Illuminate\Container\Container;
use Modules\LAM\Contracts\InstallerInterface;
use Modules\LAM\Models\Module;
use Nwidart\Modules\FileRepository;

class Lam extends FileRepository
{
    public function getWidget(): array
    {
        return Filament::getWidgets();
    }

    public function getModuleNamespace(){
        return config("modules.namespace","Modules");
    }
    public function getModuleProviderPath(){
        return config("modules.paths.generator.provider.path","Providers");
    }
    public function getModuleProviderNamespace($moduleName) :string{
        return $this->getModuleNamespace()."\\".$moduleName."\\".$this->getModuleProviderPath();
    }

    public function isVisibleForEnable($name) :bool
    {
        $module = \Lam::find($name);
        return
            !$module?->isEnabled() &&
            $module?->isInstalled() &&
            !$module?->isSystem();
    }
    public function isVisibleForDisable($name) :bool
    {
        $module = \Lam::find($name);
        return
            $module?->isEnabled() &&
            $module?->isInstalled() &&
            !$module?->isSystem();
    }
    public function isVisibleForInstall($name): bool
    {
        $module = \Lam::find($name);
        return
            !$module?->isInstalled() &&
            !$module?->isSystem();
    }
    public function isVisibleForUninstall($name): bool
    {
        $module = \Lam::find($name);
        return
            $module?->isInstalled() &&
            !$module?->isEnabled() &&
            !$module?->isSystem();
    }
    public function installModule($name)
    {
        try {
            \DB::beginTransaction();
            $module = \Lam::find($name);

            \Artisan::call("module:migrate-refresh ".$module->getName());
            app()->register($this->getModuleProviderNamespace($module->getName())."\\InstallServiceProvider");
            $module->enable();
            $module->install();
            $this->scanModules();
            \DB::commit();
        }catch (\Throwable $exception){
            \DB::rollBack();
        }


    }
    public function uninstallModule($name){
        try {
            \DB::beginTransaction();
            $module = \Lam::find($name);
            \Artisan::call("module:migrate-rollback ".$module->getName());
            app()->register($this->getModuleProviderNamespace($module->getName())."\\UninstallServiceProvider");
            $module->disable();
            $module->uninstall();
            $this->scanModules();
            \DB::commit();
        }catch (\Throwable $exception){
            info($exception->getMessage());
            \DB::rollBack();
        }

    }

    public function scanModules(): void
    {
        Module::truncate();
        $modules = \Lam::all();
        if(!empty($modules)){
            foreach ($modules as $module){
                Module::firstOrCreate(["name"=>$module->getLowerName()]);
            }
        }
    }

    protected function createModule(...$args)
    {
        return new LamModule(...$args);
    }
}
