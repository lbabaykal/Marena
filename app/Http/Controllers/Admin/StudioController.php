<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Studio\StoreRequest;
use App\Http\Requests\Admin\Studio\UpdateRequest;
use App\Marena;
use App\Models\Studio;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudioController extends Controller
{
    public function index(): View
    {
        $studios = Studio::query()
            ->orderBY('studios.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.studio.index')->with('studios', $studios);
    }

    public function show(Studio $studio): RedirectResponse
    {
        return redirect()->route('admin.studio.index');
    }

    public function create(): View
    {
        return view('admin.studio.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Studio::query()->create($data);
        return redirect()->route('admin.studios.index');
    }

    public function edit(Studio $studio): View
    {
        return view('admin.studio.edit')->with('studio', $studio);
    }

    public function update(UpdateRequest $request, Studio $studio): RedirectResponse
    {
        $data = $request->validated();
        $studio->update($data);
        return redirect()->route('admin.studios.index');
    }

    public function destroy(Studio $studio): RedirectResponse
    {
        $studio->delete();
        return redirect()->route('admin.studios.index');
    }
}
