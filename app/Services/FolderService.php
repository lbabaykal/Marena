<?php

namespace App\Services;

use App\Marena;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderService
{
    public static function getUserFolders(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Folder::query()
            ->where('user_id', auth()->id() ?? 0)
            ->orWhere('user_id', 0)
            ->get();
    }

    public function getCountUserFolders(): int
    {
        return Folder::query()->where('user_id', auth()->id())->count();
    }

    public function createFolder(Request $request)
    {
        $request['isPublic'] = $request->boolean('isPublic');
        $request['user_id'] = auth()->id();

        return Folder::query()->create($request->toArray());
    }

    public function updateFolder(Request $request, Folder $folder)
    {
        $request['isPublic'] = $request->boolean('isPublic');

        return $folder->update($request->toArray());
    }

    public function getArticlesInFolder(Folder $folder)
    {
        return Favorites::query()
            ->where('folder_id', $folder->id)
            ->where('user_id', $folder->user_id)
            ->join('articles', 'favorites.article_id', '=', 'articles.id')
            ->join('ratings', 'ratings.article_id', '=', 'articles.id')
            ->join('types', 'types.id', '=', 'articles.type_id')
            ->paginate(Marena::COUNT_ARTICLES_FOLDERS);
    }
}
