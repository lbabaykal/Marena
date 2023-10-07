<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Marena;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::orderBY('id', 'ASC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.genre.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Genre::create($data);
        return redirect(route('admin.genres.index'));
    }

    public function show(Genre $genre)
    {
        return redirect()->route('admin.genre.index');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(UpdateRequest $request, Genre $genre)
    {
        $data = $request->validated();
        $genre->update($data);
        return redirect(route('admin.genres.index'));
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect(route('admin.genres.index'));
    }
}
