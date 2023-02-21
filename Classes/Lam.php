<?php

namespace Modules\LAM\Classes;

use Nwidart\Modules\Module;

class Lam
{
    public static function getModuleNamespace(){
        return config("modules.namespace","Modules");
    }
    public static function getModuleProviderPath(){
        return config("modules.paths.generator.provider.path","Providers");
    }
    public static function getModuleProviderNamespace($moduleName) :string{
        return self::getModuleNamespace()."\\".$moduleName."\\".self::getModuleProviderPath();
    }
    public static function setInstalled(Module $module,bool $installed): void
    {
        $module->json()->set("installed",$installed)->save();
    }
    public static function isVisibleForEnable($name) :bool
    {
        $module = \Module::find($name);
        return
            //auth()->user()->can("modules.manager") &&
            !$module->isEnabled() &&
            !$module->get("type","module")=="system" &&
            $module->get("installed",false)==true;
    }
    public static function isVisibleForDisable($name) :bool
    {
        $module = \Module::find($name);
        return auth()->user()->can("modules.manager")
            && $module->isEnabled()
            && !$module->get("type","module")=="system"
            && $module->get("installed",false)==true;
    }
    public static function isVisibleForInstall($name): bool
    {
        $module = \Module::find($name);
        return auth()->user()->can("modules.manager")
            && !$module->get("type","module")=="system"
            && $module->get("installed",false)==false;
    }
    public static function isVisibleForUninstall($name): bool
    {
        $module = \Module::find($name);
        return auth()->user()->can("modules.manager")
            && !$module->get("type","module")=="system"
            && !$module->isEnabled()
            && $module->get("installed",false)==true;
    }
    public static function install($name): Module
    {
        $module = \Module::find($name);
        \Artisan::call("module:migrate-refresh ".$module->getName());
        app()->register(self::getModuleProviderNamespace($module->getName())."\\InstallServiceProvider");
        $module->enable();
        self::setInstalled($module,true);
        return $module;
    }
    public static function uninstall($name){
        $module = \Module::find($name);
        \Artisan::call("module:migrate-rollback ".$module->getName());
        app()->register(self::getModuleProviderNamespace($module->getName())."\\UninstallServiceProvider");
        $module->disable();
        self::setInstalled($module,false);
        return $module;
    }
}
