<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folder\StoreRequest;
use App\Http\Requests\Folder\UpdateRequest;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Folder::class, 'folder');
    }

    public function index(): RedirectResponse
    {
        return redirect()->route('account.favorites.index');
    }

    public function show(Folder $folder): View
    {
        $folder['articles'] = Favorites::query()
            ->where('folder_id', $folder->id)
            ->where('user_id', Auth::id())
            ->get();

        return view('account.folder.index')->with('folder', $folder);
    }

    public function create(): View
    {
        return view('account.folder.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $countFolders =  Folder::query()->where('user_id', Auth::id())->count();
        if ($countFolders < 10) {
            $data = $request->validated();
            $data['isPublic'] = $request->boolean('isPublic');
            $data['user_id'] = Auth::id();

            Folder::query()->create($data);

            return redirect()->route('account.favorites.index')
                ->with('success', 'Папка ' . $data['title'] . ' создана.');
        } else {
            return redirect()->route('account.favorites.index')
                ->with('error', 'Максимум можно создать 10 папок.');
        }
    }

    public function edit(Folder $folder): View
    {
        return view('account.folder.edit')->with('folder', $folder);
    }

    public function update(UpdateRequest $request, Folder $folder): RedirectResponse
    {
        $data = $request->validated();
        $data['isPublic'] = $request->boolean('isPublic');

        $folder->update($data);
        return redirect()->route('account.favorites.index')
            ->with('success', 'Папка ' . $data['title'] . ' обновлена.');
    }

    public function destroy(Folder $folder): RedirectResponse
    {
        $folder->delete();
        return redirect()->route('account.favorites.index')
            ->with('success', 'Папка ' . $folder->title . ' удалена.');
    }

}
