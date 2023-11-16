<?php

namespace App\Http\Controllers;

use App\Http\Filters\Folder\Title;
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
        $folders = $folderService->getUserFolders();
        $articles = $folderService->getArticlesInFolders();

        return view('account.folder.show')
            ->with('folders', $folders)
            ->with('articles', $articles);
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

    public function kek()
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
                Title::class,
            ])
            ->thenReturn();

        dd($articles->dd());
//        dd($articles->get()->toArray());
    }
}


