<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Marena;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): View
    {
        $users = User::query()->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.user.index')->with('users', $users);
    }

    public function show(User $user): RedirectResponse
    {
        return redirect()->route('admin.index');
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.index');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        return redirect()->route('admin.index');
    }

    public function edit(User $user): View
    {
        if (Auth::user()->role->id === 1 ) {
            $roles = Role::all();
        } else {
            $roles = Role::all()->where('id', '!=' , 1);
        }

        return view('admin.user.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        //Убрать эту кашу
        if ($user->role->id === 1 && Auth::user()->role->id !== 1) {
            return redirect()->route('admin.users.edit', $user->id)
                ->with('error', 'Нельзя изменить роль Администратора!');
        }

        if ((int)$request->role_id === 1 && Auth::user()->role->id !== 1) {
            return redirect()->route('admin.users.edit', $user->id)
                ->with('error', 'Роль Администратора может выдать только администратор!');
        }

        $user->update($data);
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->role->id !== 1)
        {
            $user->delete();
        }
        //Удалить оценки, заблокировать пользователя
        //if ($article->image !== 'no_image.png') Storage::disk('images_articles')->delete($article->image);
        return redirect()->route('admin.users.index');
    }

}
