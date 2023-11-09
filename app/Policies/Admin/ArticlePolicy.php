<?php

namespace App\Policies\Admin;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function viewAny(User $user): Response
    {
        return $user->role->allowView === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function view(?User $user, Article $article): Response
    {
        return $article->is_show === 1 || (isset($user) && $user->role->isAdmin === 1)
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function create(User $user): Response
    {
        return $user->role->allowCreate === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function update(User $user, Article $article): Response
    {
        return $user->role->allowUpdate === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function delete(User $user, Article $article): Response
    {
        return $user->role->allowDelete === 1
            ? Response::allow()
            : Response::denyWithStatus(403);
    }

    public function restore(User $user, Article $article): Response
    {
        return Response::denyWithStatus(403);
    }

    public function forceDelete(User $user, Article $article): Response
    {
        return Response::denyWithStatus(403);
    }
}
