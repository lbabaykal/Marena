<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(\App\Http\Requests\Admin\Comments\StoreRequest $request)
    {
        if (Auth::check())
        {
            $data = $request->validated();

            $article = Article::find($data['article_id']);
            $article->comments()->create([
                'user_id' => Auth::id(),
                'comment' => $data['comment'],
                'date' => date('Y-m-d H:i:s'),
                'commentable_type' => Article::class
            ]);
            return ['success' => 'Yes'];
        } else  {
            return ['success' => 'No'];
        }
    }
}
