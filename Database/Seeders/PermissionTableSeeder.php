<?php

namespace Modules\LAM\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\LAM\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $admin = Role::firstOrCreate(['name'=>'admin']);
        $moduleName = "lam";
        $models =[
            "users",
            "roles",
            "permissions",
            "modules",
            "activities",
        ];
        foreach ($models as $model){
            $levels = [
                'viewAny',
                'view',
                'create',
                'update',
                'delete',
                'forceDelete',
                'manager',
            ];
            foreach ($levels as $level){
                $permission = Permission::findOrCreate($model.'.'.$level);
                if(!empty($permission)){
                    $permission->module = $moduleName;
                    $permission->save();
                    if($level=="manager"){
                        $admin->givePermissionTo($permission);
                    }
                }
            }
        }
        $user = User::create([
            "name"=>"Administrator",
            "email"=>"admin@demo.com",
            "password"=>\Hash::make("12345678"),
        ]);

        $user->assignRole($admin->name);
    }

    public function rollback()
    {
        Model::unguard();
        User::where("email","admin@demo.com")->delete();
    }
}
