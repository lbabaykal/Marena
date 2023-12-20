<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Marena;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): View
    {
        $users = User::query()
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'Administrator');
            })
            ->paginate(Marena::COUNT_ADMIN_ITEMS);

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
        $roles = Role::all()
            ->where('guard_name', '=', 'web')
            ->where('name', '!=' , 'Administrator');

        return view('admin.user.edit')
            ->with('user', $user)
            ->with('roles', $roles);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        $role = Role::findById($data['role_id']);
        unset($data['role_id']);

//        dd($role->name);
        $user->update($data);
        $user->syncRoles($role->name);

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
