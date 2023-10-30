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
use App\Models\Folder;
use App\Models\RatingAssessment;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        if ($article->is_show === 0) {
            return redirect()->route('main.show');
        }

        $article->genre_id = $article->genres;
        $article->user_assessment = RatingAssessment::query()
            ->where('user_id', Auth::id())
            ->where('article_id', $article->id)
            ->value('assessment');

        $articleComments = $article->comments;

        $favorite = Favorites::query()
            ->where('article_id', $article->id)
            ->where('user_id', Auth::id())
            ->get();

        $folders = Auth::id() ? Folder::findUserFolders(Auth::id()) : Folder::findUserFolders(0);

        return view('layouts.main.article')
            ->with('article', $article)
            ->with('articleComments', $articleComments)
            ->with('folders', $folders)
            ->with('favorite', $favorite);
    }

    public function filter_article(): View
    {
        $articles = app()->make(Pipeline::class)
            ->send(Article::query()
                ->where('is_show', 1)
                ->orderByDesc('articles.id')
            )
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

        return view('layouts.filter_article')
            ->with('articles', $articles->paginate(Marena::COUNT_ARTICLES_FULL))
            ->with('categories', \App\Models\Category::all())
            ->with('types', \App\Models\Type::all())
            ->with('genres', \App\Models\Genre::all())
            ->with('countries', \App\Models\Country::all());
    }
}
