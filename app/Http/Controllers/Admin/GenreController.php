<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Marena;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GenreController extends Controller
{
    public function index(): View
    {
        $genres = Genre::query()
            ->orderBY('genres.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.genre.index')->with('genres', $genres);
    }

    public function show(Genre $genre): RedirectResponse
    {
        return redirect()->route('admin.genre.index');
    }

    public function create(): View
    {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Genre::query()->create($data);
        return redirect(route('admin.genres.index'));
    }

    public function edit(Genre $genre): View
    {
        return view('admin.genre.edit')->with('genre', $genre);
    }

    public function update(UpdateRequest $request, Genre $genre): RedirectResponse
    {
        $data = $request->validated();
        $genre->update($data);
        return redirect(route('admin.genres.index'));
    }

    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();
        return redirect(route('admin.genres.index'));
    }

}
