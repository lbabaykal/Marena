<?php

namespace App\Http\Controllers;

use App\Http\Requests\FavoritesRequest;
use App\Models\Favorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __invoke(FavoritesRequest $request)
    {
        if (Auth::check())
        {
            $data = $request->validated();
            $user = Auth::user();
            if (Favorites::where('user_id', Auth::id())->where('article_id', $data['article_id'])->exists())
            {
                $user->favorites()->toggle($data);
                return ['success' => 'Yess'];
            } else {
                $user->favorites()->toggle($data);
                return ['success' => 'Yes'];
            }

        } else  {
            return ['success' => 'No'];
        }
    }
}
