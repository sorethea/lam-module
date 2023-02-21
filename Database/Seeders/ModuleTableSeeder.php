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
        $modules = \Module::all();
        if(!empty($modules)){
            foreach ($modules as $module){
                Module::firstOrCreate(["name"=>$module->getLowerName()]);
            }
        }
    }

    public function rollback(){
        Model::unguard();
    }
}
