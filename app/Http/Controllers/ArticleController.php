<?php

namespace App\Http\Controllers;

use App\Http\Filters\Article\Category;
use App\Http\Filters\Article\Country;
use App\Http\Filters\Article\Genre;
use App\Http\Filters\Article\Title;
use App\Http\Filters\Article\Type;
use App\Http\Filters\Article\YearFrom;
use App\Http\Filters\Article\YearTo;
use App\Marena;
use App\Models\Article;
use App\Models\Favorites;
use App\Models\RatingAssessment;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show(Article $article)
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

    public function filter_article() {
        $articles = app()->make(Pipeline::class)
            ->send(Article::query())
            ->through([
                Title::class,
                Category::class,
                Type::class,
                Genre::class,
                Country::class,
                YearFrom::class,
                YearTo::class,
            ])
            ->thenReturn();
        $articles = $articles->paginate(Marena::COUNT_ARTICLES_FULL);

        $categories = \App\Models\Category::all();
        $types = \App\Models\Type::all();
        $genres = \App\Models\Genre::all();
        $countries = \App\Models\Country::all();
        return view('layouts.filter_article', compact('articles', 'categories', 'types', 'genres', 'countries'));
    }
}
