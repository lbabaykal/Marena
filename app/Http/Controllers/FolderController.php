<?php

namespace App\Http\Controllers;

use App\Http\Requests\Folder\StoreRequest;
use App\Http\Requests\Folder\UpdateRequest;
use App\Marena;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
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

    public function index(): View
    {
        $folders = Folder::findUserFolders(Auth::id());
        $articles = Favorites::query()
            ->where('user_id', Auth::id())
            ->join('articles', 'article_id', '=', 'articles.id')
            ->join('ratings', 'ratings.article_id', '=', 'articles.id')
            ->join('types', 'types.id', '=', 'articles.type_id')
            ->paginate(Marena::COUNT_ARTICLES_FOLDERS);

        return view('account.folder.show')->with('folders', $folders)->with('articles', $articles);
    }

    public function show(Folder $folder): View
    {
        $folders = Folder::findUserFolders(Auth::id());
        $articles = Favorites::query()
            ->where('folder_id', $folder->id)
            ->where('user_id', Auth::id())
            ->join('articles', 'article_id', '=', 'articles.id')
            ->join('ratings', 'ratings.article_id', '=', 'articles.id')
            ->join('types', 'types.id', '=', 'articles.type_id')
            ->paginate(Marena::COUNT_ARTICLES_FOLDERS);

        return view('account.folder.show')->with('folders', $folders)->with('articles', $articles);
    }

    public function create(): View
    {
        return view('account.folder.create');
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $countFolders =  Folder::query()->where('user_id', Auth::id())->count();
        if ($countFolders < 10) {
            $data = $request->validated();
            $data['isPublic'] = $request->boolean('isPublic');
            $data['user_id'] = Auth::id();

            Folder::query()->create($data);

            return response()->json([
                'status' => 'success',
                'text' => 'Папка ' . $data['title'] . ' создана.',
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'text' => 'Максимум можно создать 10 папок.',
            ]);
        }
    }

    public function edit(Folder $folder): View
    {
        return view('account.folder.edit')->with('folder', $folder);
    }

    public function update(UpdateRequest $request, Folder $folder): JsonResponse
    {
        $data = $request->validated();
        $data['isPublic'] = $request->boolean('isPublic');

        $folder->update($data);

        return response()->json([
            'status' => 'success',
            'text' => 'Папка обновлена.',
        ]);
    }

    public function destroy(Folder $folder): RedirectResponse
    {
        $folder->delete();
        return redirect()->route('account.folders.index')
            ->with('success', 'Папка ' . $folder->title . ' удалена.');
    }

}
