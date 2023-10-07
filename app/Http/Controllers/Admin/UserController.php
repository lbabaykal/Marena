<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Marena;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $users = User::paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return redirect()->route('admin.index');
    }

    public function store(StoreRequest $request)
    {
        return redirect()->route('admin.index');
    }

    public function show(User $user)
    {
        return redirect()->route('admin.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all()->where('id', '!=' , 1);
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return redirect(route('admin.users.index'));
    }

    public function destroy(User $user)
    {
        if ($user->role->id !== 1 )
        {
            $user->delete();
        }
        //Удалить оценки, заблокировать пользователя
        //if ($article->image !== 'no_image.png') Storage::disk('images_articles')->delete($article->image);
        return redirect(route('admin.users.index'));
    }
}
