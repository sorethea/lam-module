<?php

namespace Modules\LAM\Classes;

use Illuminate\Container\Container;
use Modules\LAM\Contracts\InstallerInterface;
use Modules\LAM\Models\Module;
use Nwidart\Modules\FileRepository;

class Lam extends FileRepository
{
//    private $app;
//    private $installer;
//    public function __construct(Container $app)
//    {
//        $this->app = $app;
//        //$this->installer = $this->app[InstallerInterface::class];
//    }

    public function getModuleNamespace(){
        return config("modules.namespace","Modules");
    }
    public function getModuleProviderPath(){
        return config("modules.paths.generator.provider.path","Providers");
    }
    public function getModuleProviderNamespace($moduleName) :string{
        return self::getModuleNamespace()."\\".$moduleName."\\".self::getModuleProviderPath();
    }
    public function setInstalled($module,bool $installed): void
    {
        $module->json()->set("installed",$installed)->save();
    }
    public function isInstalled($module):bool{
        return $module->json()->get("installed",false);
    }
    public static function isSystem($module):bool{
        return $module->json()->get("type","module")=="system";
    }
    public function isVisibleForEnable($name) :bool
    {
        $module = \Module::find($name);
        return
            auth()->user()->can("modules.manager") &&
            !$module->isEnabled() &&
            self::isInstalled($module) &&
            !self::isSystem($module);
    }
    public function isVisibleForDisable($name) :bool
    {
        $module = \Module::find($name);
        return
            auth()->user()->can("modules.manager") &&
            $module->isEnabled() &&
            !self::isSystem($module) &&
            self::isInstalled($module);
    }
    public function isVisibleForInstall($name): bool
    {
        $module = \Module::find($name);
        return
            auth()->user()->can("modules.manager") &&
            !self::isSystem($module) &&
            !self::isInstalled($module);
    }
    public function isVisibleForUninstall($name): bool
    {
        $module = \Module::find($name);
        return
            auth()->user()->can("modules.manager") &&
            !self::isSystem($module) &&
            !$module->isEnabled() &&
            self::isInstalled($module);
    }
    public function installModule($name=null)
    {
        try {
            \DB::beginTransaction();
            $module = \Module::find($name);
            \Artisan::call("module:migrate-refresh ".$module->getName());
            app()->register(self::getModuleProviderNamespace($module->getName())."\\InstallServiceProvider");
            $module->enable();
            self::setInstalled($module,true);
            \DB::commit();
        }catch (\Throwable $exception){
            \DB::rollBack();
        }


    }
    public static function uninstallModule($name=null){
        try {
            \DB::beginTransaction();
            $module = \Module::find($name);
            \Artisan::call("module:migrate-rollback ".$module->getName());
            app()->register(self::getModuleProviderNamespace($module->getName())."\\UninstallServiceProvider");
            $module->disable();
            self::setInstalled($module,false);
            \DB::commit();
        }catch (\Throwable $exception){
            \DB::rollBack();
        }

    }

    public static function scanModules(): void
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
