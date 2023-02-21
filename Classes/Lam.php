<?php

namespace Modules\LAM\Classes;

use Nwidart\Modules\Module;

class Lam
{
    private function getModuleNamespace(){
        return config("modules.namespace","Modules");
    }
    private function getModuleProviderPath(){
        return config("modules.paths.generator.provider.path","Providers");
    }
    public static function getModuleProviderNamespace($moduleName) :string{
        return self::getModuleNamespace()."\\".$moduleName."\\".self::getModuleProviderPath();
    }
    public static function install($name): Module
    {
        $module = \Module::find($name);
        app()->register(self::getModuleProviderNamespace($module->getName())."\\InstallServiceProvider");
        $module->json()->set("installed",true)->save();
        return $module;
    }
}
