<?php

namespace Modules\LAM\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\LAM\Models\User;
use Modules\LAM\Policies\PermissionPolicy;
use Modules\LAM\Policies\RolePolicy;
use Modules\LAM\Policies\UserPolicy;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies=[
        User::class => UserPolicy::class,
        Permission::class => PermissionPolicy::class,
        Role::class => RolePolicy::class
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPolicies();
    }

}
