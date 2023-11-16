<?php

namespace App\Http\Controllers;

use App\Http\Filters\Article\Category;
use App\Http\Filters\Article\Country;
use App\Http\Filters\Article\Genre;
use App\Http\Filters\Article\Title;
use App\Http\Filters\Article\Type;
use App\Http\Filters\Article\YearFrom;
use App\Http\Filters\Article\YearTo;
use App\Http\Resources\ArticleResource;
use App\Marena;
use App\Models\Article;
use App\Models\Favorites;
use App\Models\RatingAssessment;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\View\View;
use App\Services\FolderService;

class ArticleController extends Controller
{
    public function show(Article $article, FolderService $folderService): View
    {
        $this->authorize('view', $article);

        $article->comments_count = $article->comments()->count();
        $article->user_assessment = RatingAssessment::query()
            ->where('user_id', auth()->id())
            ->where('article_id', $article->id)
            ->value('assessment');

        $favorite = Favorites::query()
            ->where('article_id', $article->id)
            ->where('user_id', auth()->id())
            ->get();

        $folders = $folderService->getUserFolders();

        return view('layouts.main.article')
            ->with('article', $article)
            ->with('folders', $folders)
            ->with('favorite', $favorite);
    }

    public function filter(): View
    {
        $articles = app()->make(Pipeline::class)
            ->send(Article::query()->where('is_show', 1))
            ->through([
                Title::class,
                Category::class,
                Type::class,
                Genre::class,
                Country::class,
                YearFrom::class,
                YearTo::class,
            ])
            ->thenReturn()->dd();

        return view('layouts.filter_article')
            ->with('articles', $articles->paginate(Marena::COUNT_ARTICLES_FULL))
            ->with('categories', \App\Models\Category::all())
            ->with('types', \App\Models\Type::all())
            ->with('genres', \App\Models\Genre::all())
            ->with('countries', \App\Models\Country::all());
    }

    public function articleResource(Article $article)
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
