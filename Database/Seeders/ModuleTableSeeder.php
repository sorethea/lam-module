<?php

namespace Modules\LAM\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LAM\Models\Module;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        \Lam::scan();
    }

    public function rollback(){
        Model::unguard();
    }
}
