<?php

namespace Modules\LAM\Providers;

use Modules\LAM\Database\Seeders\LAMDatabaseSeeder;

class InstallServiceProvider extends BaseInstallServiceProvider
{
    public function install()
    {
        $seed = new LAMDatabaseSeeder();
        $seed->run();
    }
}
