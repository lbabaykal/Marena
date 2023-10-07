<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Studio\StoreRequest;
use App\Http\Requests\Admin\Studio\UpdateRequest;
use App\Marena;
use App\Models\Studio;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::orderBY('id', 'ASC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.studio.index', compact('studios'));
    }

    public function create()
    {
        return view('admin.studio.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Studio::create($data);
        return redirect(route('admin.studios.index'));
    }

    public function show(Studio $studio)
    {
        return redirect()->route('admin.studio.index');
    }

    public function edit(Studio $studio)
    {
        return view('admin.studio.edit', compact('studio'));
    }

    public function update(UpdateRequest $request, Studio $studio)
    {
        $data = $request->validated();
        $studio->update($data);
        return redirect(route('admin.studios.index'));
    }

    public function destroy(Studio $studio)
    {
        $studio->delete();
        return redirect(route('admin.studios.index'));
    }
}
