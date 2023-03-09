<?php

namespace Modules\LAM\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\LAM\Commands\AuthProviderCommand;
use Modules\LAM\Commands\InstallCommand;
use Modules\LAM\Commands\InstallProviderCommand;
use Modules\LAM\Commands\MakeCommand;
use Modules\LAM\Commands\PolicyCommand;
use Modules\LAM\Commands\ProviderCommand;
use Modules\LAM\Commands\ResourceCommand;
use Modules\LAM\Commands\ResourceProviderCommand;
use Modules\LAM\Commands\UninstallCommand;
use Modules\LAM\Commands\UninstallProviderCommand;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            InstallCommand::class,
            UninstallCommand::class,
            MakeCommand::class,
            ProviderCommand::class,
            PolicyCommand::class,
            AuthProviderCommand::class,
            ResourceProviderCommand::class,
            ResourceCommand::class,
            InstallProviderCommand::class,
            UninstallProviderCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
