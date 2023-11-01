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
        if ($user->role->id === 1) {
            return Response::allow();
        } elseif ($user->role->allowUpdate === 1 && $model->role->id !== 1) {
            return Response::allow();
        } else {
            return Response::denyWithStatus(403);
        }
    }

    public function delete(User $user, User $model): Response
    {
        return $user->role->allowDelete === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function restore(User $user, User $model): Response
    {
        return Response::denyWithStatus(403);
    }

    public function forceDelete(User $user, User $model): Response
    {
        return Response::denyWithStatus(403);
    }
}
