<?php

namespace App\Http\Controllers;

use App\Http\Filters\Folder\Category;
use App\Http\Filters\Folder\Genre;
use App\Http\Filters\Folder\Type;
use App\Http\Requests\Folder\StoreRequest;
use App\Http\Requests\Folder\UpdateRequest;
use App\Marena;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pipeline\Pipeline;
use Illuminate\View\View;
use App\Services\FolderService;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Folder::class, 'folder');
    }

    public function index(FolderService $folderService): View
    {
        $articles = app()->make(Pipeline::class)
            ->send(Favorites::query()
                ->where('is_show', 1)
                ->where('user_id', auth()->id())
                ->join('articles', 'favorites.article_id', '=', 'articles.id')
                ->join('ratings', 'ratings.article_id', '=', 'articles.id')
                ->join('types', 'types.id', '=', 'articles.type_id')
            )
            ->through([
                Category::class,
                Genre::class,
                Type::class,
            ])
            ->thenReturn();

        return view('account.folder.show')
            ->with('categories', \App\Models\Category::all())
            ->with('types', \App\Models\Type::all())
            ->with('genres', \App\Models\Genre::all())
            ->with('folders', $folderService->getUserFolders())
            ->with('articles', $articles->paginate(Marena::COUNT_ARTICLES_FOLDERS));
    }

    public function show(Folder $folder, FolderService $folderService): View
    {
        $folders = $folderService->getUserFolders();
        $articles = $folderService->getArticlesInFolder($folder);

        return view('account.folder.show')
            ->with('folders', $folders)
            ->with('articles', $articles);
    }

    public function create(): View
    {
        return view('account.folder.create');
    }

    public function store(StoreRequest $request, FolderService $folderService): RedirectResponse
    {
        if ($folderService->getCountUserFolders() > Marena::COUNT_FOLDERS) {
            return redirect()->route('account.folders.index');
        }

        $folderService->createFolder($request);

        return redirect()->route('account.folders.index');
    }

    public function edit(Folder $folder): View
    {
        return view('account.folder.edit')->with('folder', $folder);
    }

    public function update(UpdateRequest $request, Folder $folder, FolderService $folderService): RedirectResponse
    {
        $folderService->updateFolder($request, $folder);

        return redirect()->route('account.folders.index');
    }

    public function destroy(Folder $folder): RedirectResponse
    {
        $folder->delete();

        return redirect()->route('account.folders.index');
    }

}


