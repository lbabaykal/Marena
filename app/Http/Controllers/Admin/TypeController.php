<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Type\StoreRequest;
use App\Http\Requests\Admin\Type\UpdateRequest;
use App\Marena;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBY('id', 'ASC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.type.index', compact('types'));
    }

    public function create()
    {
        return view('admin.type.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Type::create($data);
        return redirect(route('admin.types.index'));
    }

    public function show(Type $type)
    {
        return redirect()->route('admin.type.index');
    }

    public function edit(Type $type)
    {
        return view('admin.type.edit', compact('type'));
    }

    public function update(UpdateRequest $request, Type $type)
    {
        $data = $request->validated();
        $type->update($data);
        return redirect(route('admin.types.index'));
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect(route('admin.types.index'));
    }
}
