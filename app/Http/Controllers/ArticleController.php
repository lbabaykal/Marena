<?php

namespace App\Http\Controllers;

use App\Http\Filters\Article\Category;
use App\Http\Filters\Article\Country;
use App\Http\Filters\Article\Genre;
use App\Http\Filters\Article\Studio;
use App\Http\Filters\Article\Title;
use App\Http\Filters\Article\Type;
use App\Http\Filters\Article\YearFrom;
use App\Http\Filters\Article\YearTo;
use App\Http\Resources\ArticleResource;
use App\Marena;
use App\Models\Article;
use App\Models\Favorites;
use App\Models\Rating;
use App\Models\Team;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\FolderService;

class ArticleController extends Controller
{

    public function show(Article $article, FolderService $folderService): View
    {
        $this->authorize('view', $article);

        $article->comments_count = $article->comments()->count();
        $article->duration = CarbonInterval::minutes($article->duration)->cascade()->forHumans(['short' => true]);
        $article->release = Carbon::parse($article->release)->format('d.m.Y');

        $userFolders = $folderService->getUserFolders();

        $userRating = Rating::query()
            ->where('user_id', Auth::id())
            ->where('article_id', $article->id)
            ->value('assessment');

        $userFavorite = Favorites::query()
            ->where('user_id', Auth::id())
            ->where('article_id', $article->id)
            ->get();

        return view('layouts.main.article')
            ->with('article', $article)
            ->with('userFolders', $userFolders)
            ->with('userRating', $userRating)
            ->with('userFavorite', $userFavorite);
    }

    public function filter(): View
    {
        $articles = app()->make(Pipeline::class)
            ->send(Article::query()->status('PUBLISHED'))
            ->through([
                Title::class,
                Category::class,
                Type::class,
                Genre::class,
                Country::class,
                Studio::class,
                YearFrom::class,
                YearTo::class,
            ])
            ->thenReturn();

        return view('layouts.filter_article')
            ->with('articles', $articles->paginate(Marena::COUNT_ARTICLES_FULL))
            ->with('categories', \App\Models\Category::all())
            ->with('types', \App\Models\Type::all())
            ->with('genres', \App\Models\Genre::all())
            ->with('studios', \App\Models\Studio::all())
            ->with('countries', \App\Models\Country::all());
    }

    public function team(Article $article, Team $team)
    {
        return $article->id . ' - ' . $team->id;
    }

    public function articleResource(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }

    public function articlesResource(Request $request)
    {
        $articles = Article::query()
            ->paginate($request['per_page'], ['*'], 'page', $request['page']);

        return ArticleResource::collection($articles);
    }

}
