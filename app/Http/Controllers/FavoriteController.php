<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorite\DestroyRequest;
use App\Http\Requests\Favorite\UpdateRequest;
use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
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

    public function store(UpdateRequest $request): JsonResponse
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
            return response()->json([
                'status' => 'success',
                'text' => 'Добавлено в список!',
            ]);
        } else  {
            return response()->json([
                'status' => 'warning',
                'text' => 'Необходимо авторизоваться!',
            ]);
        }
    }

    public function destroy(DestroyRequest $request): JsonResponse
    {
        if (Auth::check()) {
            $data = $request->validated();

            Favorites::where('user_id', Auth::id())
                ->where($data)
                ->delete();

            return response()->json([
                'status' => 'success',
                'text' => 'Удалено из списка!',
            ]);
        } else  {
            return response()->json([
                'status' => 'warning',
                'text' => 'Необходимо авторизоваться!',
            ]);
        }
    }

}
