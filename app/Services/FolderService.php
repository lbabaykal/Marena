<?php

namespace App\Services;

use App\Marena;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderService
{
    public static function getUserFolders(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Folder::query()
            ->where('user_id', auth()->id())
            ->orWhere('user_id', 0)
            ->get();
    }

    public function getCountUserFolders(): int
    {
        return auth()->user()->folders()->count();
    }

    public function createFolder(Request $request)
    {
        $data = $request->validated();
        $data['isPublic'] = $request->boolean('isPublic');

        return auth()->user()->folders()->create($data);
    }

    public function updateFolder(Request $request, Folder $folder)
    {
        $data = $request->validated();
        $data['isPublic'] = $request->boolean('isPublic');

        return $folder->update($data);
    }

    public function getArticlesInFolder(Folder $folder)
    {
        return auth()->user()->favorites()
            ->where('folder_id', $folder->id)
            ->join('articles', 'favorites.article_id', '=', 'articles.id')
            ->join('article_extended', 'article_extended.article_id', '=', 'articles.id')
            ->join('types', 'types.id', '=', 'articles.type_id')
            ->paginate(Marena::COUNT_ARTICLES_FOLDERS);
    }
}
