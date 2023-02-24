<?php

namespace Modules\LAM\Providers;


use Modules\LAM\Database\Seeders\LAMDatabaseSeeder;

class UninstallServiceProvider extends BaseUninstallServiceProvider
{
    public function uninstall()
    {
        $seed = new LAMDatabaseSeeder();
        $seed?->rollback();
    }
}
