<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    public function viewAny(User $user): Response
    {
        return $user->role->id === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function view(User $user, Role $role): Response
    {
        return $user->role->id === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        return $user->role->id === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function update(User $user, Role $role): Response
    {
        return $user->role->id === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, Role $role): Response
    {
        return $user->role->id === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function restore(User $user, Role $role): bool
    {
        return 0;
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return 0;
    }
}
