<?php

namespace Modules\LAM\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LAMDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(ModuleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
    }

    public function rollback(){
        Model::unguard();
        $moduleSeeder = new ModuleTableSeeder();
        $moduleSeeder->rollback();
        $permissionSeeder = new PermissionTableSeeder();
        $permissionSeeder->rollback();
    }
}
