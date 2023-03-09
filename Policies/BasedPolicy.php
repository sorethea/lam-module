<?php

namespace Modules\LAM\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LAM\Models\User;

class BasedPolicy
{
    use HandlesAuthorization;
    private string $model;

    public function config($level): string{
        return "{$this->model}.{$level}";
    }
    public function before(User $user): bool{
        return $user->can($this->config("manager"));
    }

    public function viewAny(User $user): bool{
        return $user->can($this->config("viewAny"));
    }

    public function view(User $user, User $model): bool{
        return $user->can($this->config("view"));
    }

    public function create(User $user):bool{
        return $user->can($this->config("create"));
    }

    public function update(User $user):bool{
        return $user->can($this->config("update"));
    }
    public function delete(User $user):bool{
        return $user->can($this->config("delete"));
    }
    public function restore(User $user):bool{
        return $user->can($this->config("restore"));
    }
    public function forceDelete(User $user):bool{
        return $user->can($this->config("forceDelete"));
    }

    /**
     * @param string $model
     * @return BasedPolicy
     */
    public function setModel(string $model): BasedPolicy
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @param string $module
     * @return BasedPolicy
     */
    public function setModule(string $module): BasedPolicy
    {
        $this->module = $module;
        return $this;
    }

    /**
     * @return string
     */
    public function getModule(): string
    {
        return $this->module;
    }
}
