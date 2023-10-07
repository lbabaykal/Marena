<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->role->allowView === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function view(User $user, User $model): Response
    {
        return $user->role->allowView === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        return $user->role->allowCreate === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function update(User $user, User $model): Response
    {
        return $user->role->allowUpdate === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, User $model): Response
    {
        return $user->role->allowDelete === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function restore(User $user, User $model): bool
    {
        return 0;
    }

    public function forceDelete(User $user, User $model): bool
    {
        return 0;
    }
}
