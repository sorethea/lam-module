<?php

namespace Modules\LAM\Providers;

use Illuminate\Support\ServiceProvider;

class BaseUninstallServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app()->booted(function () {
            $this->uninstall();
        });
    }

    public function uninstall(){

    }
}
