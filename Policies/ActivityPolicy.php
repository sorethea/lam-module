<?php

namespace Modules\LAM\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class ActivityPolicy
{
    use HandlesAuthorization;

    public function before(User $user): bool{
        return $user->can("activities.manager");
    }

    public function viewAny(User $user): bool{
        return $user->can("activities.viewAny");
    }

    public function view(User $user, User $model): bool{
        return $user->can("activities.view");
    }

    public function create(User $user):bool{
        return $user->can('activities.create');
    }

    public function update(User $user):bool{
        return $user->can('activities.update');
    }
    public function delete(User $user):bool{
        return $user->can('activities.delete');
    }
    public function restore(User $user):bool{
        return $user->can('activities.restore');
    }
    public function forceDelete(User $user):bool{
        return $user->can('activities.forceDelete');
    }
}
