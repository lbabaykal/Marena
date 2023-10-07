<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Favorites;
use App\Models\RatingAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __invoke(Article $article)
    {
        $article->genre_id = $article->genres;
        $article->favorite = Favorites::where('user_id', Auth::id())
                                        ->where('article_id', $article->id)
                                        ->exists();
        $article->user_assessment = RatingAssessment::where('user_id', Auth::id())
                                                    ->where('article_id', $article->id)
                                                    ->value('assessment');
        $articleComments = $article->comments;
        return ($article->is_show === 0)
            ? redirect(route('main.show'))
            : view('main.article', compact('article', 'articleComments'));
    }
}
