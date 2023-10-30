<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Type\StoreRequest;
use App\Http\Requests\Admin\Type\UpdateRequest;
use App\Marena;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TypeController extends Controller
{
    public function index(): View
    {
        $types = Type::query()
            ->orderBY('types.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.type.index')->with('types', $types);
    }

    public function show(Type $type): RedirectResponse
    {
        return redirect()->route('admin.type.index');
    }

    public function create(): View
    {
        return view('admin.type.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Type::query()->create($data);
        return redirect()->route('admin.types.index');
    }

    public function edit(Type $type): View
    {
        return view('admin.type.edit')->with('type', $type);
    }

    public function update(UpdateRequest $request, Type $type): RedirectResponse
    {
        $data = $request->validated();
        $type->update($data);
        return redirect()->route('admin.types.index');
    }

    public function destroy(Type $type): RedirectResponse
    {
        $type->delete();
        return redirect()->route('admin.types.index');
    }

}
