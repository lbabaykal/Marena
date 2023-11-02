<?php

namespace App\Policies;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class FolderPolicy
{
    public function viewAny(User $user): Response
    {
        return $user->id === Auth::id()
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function view(User $user, Folder $folder): Response
    {
        return $user->id === $folder->user_id || $folder->isPublic === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        return $user->id === Auth::id()
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function update(User $user, Folder $folder): Response
    {
        return $user->id === $folder->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, Folder $folder): Response
    {
        return $user->id === $folder->user_id
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function restore(User $user, Folder $folder): Response
    {
        return Response::denyWithStatus(403);
    }

    public function forceDelete(User $user, Folder $folder): Response
    {
        return Response::denyWithStatus(403);
    }

}
