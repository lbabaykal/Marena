<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Marena;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index()
    {
        $roles = Role::paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $data['isAdmin'] = isset($data['isAdmin']);
        $data['allowView'] = isset($data['allowView']);
        $data['allowCreate'] = isset($data['allowCreate']);
        $data['allowUpdate'] = isset($data['allowUpdate']);
        $data['allowDelete'] = isset($data['allowDelete']);
        Role::create($data);
        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        return redirect()->route('admin.index');
    }

    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        $data = $request->validated();
        $data['isAdmin'] = isset($data['isAdmin']);
        $data['allowView'] = isset($data['allowView']);
        $data['allowCreate'] = isset($data['allowCreate']);
        $data['allowUpdate'] = isset($data['allowUpdate']);
        $data['allowDelete'] = isset($data['allowDelete']);
        $role->update($data);
        return redirect(route('admin.roles.index'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        //Удалить оценки, заблокировать пользователя
        //if ($article->image !== 'no_image.png') Storage::disk('images_articles')->delete($article->image);
        return redirect(route('admin.users.index'));
    }
}
