<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Task $task): bool
    {
        return $task->user->is($user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Task $task): bool
    {
        return $this->view($user,$task);
    }

    public function delete(User $user, Task $task): bool
    {
        return $this->view($user,$task);
    }

    public function restore(User $user, Task $task): bool
    {
        return $this->view($user,$task);
    }

    public function forceDelete(User $user, Task $task): bool
    {
        return $this->view($user,$task);
    }
}
