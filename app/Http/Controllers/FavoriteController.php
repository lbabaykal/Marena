<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorite\DestroyRequest;
use App\Http\Requests\Favorite\UpdateRequest;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function index()
    {
        $folders = Folder::findUserFolders(Auth::id());
        //Для Вывода всего и вся сразу
        /*        $favorites = Favorites::query()
                    ->where('user_id', Auth::id())
                    ->get();

                $folders->each(function ($folder) use ($favorites) {
                    $folder['articles'] = collect($favorites)->where('folder_id', $folder['id'])->all();
                });*/

        return view('account.favorites', compact('folders'));
    }

    public function store(UpdateRequest $request)
    {
        if (Auth::check()) {
            $data = $request->validated();
            $folder = Folder::find($data['folder_id']);

            if ($folder->user_id === Auth::id() || $folder->user_id === 0)
                Favorites::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'article_id' => $data['article_id']
                    ],
                    [
                        'folder_id' => $data['folder_id']
                    ]
                );
            return ['success' => 'Yes'];
        } else  {
            return ['success' => 'No'];
        }
    }

    public function destroy(DestroyRequest $request)
    {
        if (Auth::check()) {
            $data = $request->validated();

            Favorites::where('user_id', Auth::id())
                ->where($data)
                ->delete();

            return ['success' => 'Yes'];
        } else  {
            return ['success' => 'No'];
        }
    }

}
