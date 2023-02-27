<?php

namespace Modules\LAM\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class ModulePolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("modules.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("modules.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("modules.view");
    }

    public function create(User $user):bool{
        return $user->can('modules.create');
    }

    public function update(User $user):bool{
        return $user->can('modules.update');
    }
    public function delete(User $user):bool{
        return $user->can('modules.delete');
    }
    public function restore(User $user):bool{
        return $user->can('modules.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('modules.forceDelete');
    }
}
