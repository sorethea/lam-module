<?php

namespace Modules\LAM\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class UtilityPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("utilities.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("utilities.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("utilities.view");
    }

    public function create(User $user):bool{
        return $user->can('utilities.create');
    }

    public function update(User $user):bool{
        return $user->can('utilities.update');
    }
    public function delete(User $user):bool{
        return $user->can('utilities.delete');
    }
    public function restore(User $user):bool{
        return $user->can('utilities.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('utilities.forceDelete');
    }
}
