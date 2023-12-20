<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoriteRequest;
use App\Models\Folder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function store(FavoriteRequest $request): JsonResponse
    {
        if (Auth::check()) {
            $data = $request->validated();
            $folder = Folder::query()->findOrFail($data['folder_id']);

            if ($folder->user_id === Auth::id() || $folder->user_id === 0) {

                \auth()->user()->favorites()->updateOrCreate(
                    ['article_id' => $data['article_id']],
                    ['folder_id' => $data['folder_id']]
                );

                return response()->json([
                    'status' => 'success',
                    'text' => 'Добавлено в список!',
                ]);
            } else {
                return response()->json([
                    'status' => 'warning',
                    'text' => 'Это не твоя папка пёс!',
                ]);
            }

        } else  {
            return response()->json([
                'status' => 'warning',
                'text' => 'Необходимо авторизоваться!',
            ]);
        }
    }

    public function destroy(FavoriteRequest $request): JsonResponse
    {
        if (Auth::check()) {
            $data = $request->validated();

            \auth()->user()->favorites()->where($data)->delete();

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
