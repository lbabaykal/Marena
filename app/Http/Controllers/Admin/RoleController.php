<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use App\Marena;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Role::class, 'role');
    }

    public function index(): View
    {
        $roles = Role::query()->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.role.index')->with('roles', $roles);
    }

    public function show(Role $role): RedirectResponse
    {
        return redirect()->route('admin.index');
    }

    public function create(): View
    {
        return view('admin.role.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['isAdmin'] = $request->boolean('isAdmin');
        $data['allowView'] = $request->boolean('allowView');
        $data['allowCreate'] = $request->boolean('allowCreate');
        $data['allowUpdate'] = $request->boolean('allowUpdate');
        $data['allowDelete'] = $request->boolean('allowDelete');

        Role::query()->create($data);
        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role): View
    {
        return view('admin.role.edit')->with('role', $role);
    }

    public function update(UpdateRequest $request, Role $role): RedirectResponse
    {
        $data = $request->validated();
        $data['isAdmin'] = $request->boolean('isAdmin');
        $data['allowView'] = $request->boolean('allowView');
        $data['allowCreate'] = $request->boolean('allowCreate');
        $data['allowUpdate'] = $request->boolean('allowUpdate');
        $data['allowDelete'] = $request->boolean('allowDelete');

        $role->update($data);
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }

}
