<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\UpdateRequest;
use App\Marena;
use App\Models\Article;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Studio;
use App\Models\Type;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index(): View
    {
        $articles = Article::query()
            ->status('PUBLISHED')
            ->orderByDesc('articles.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);

        return view('admin.article.index')->with('articles', $articles);
    }

    public function show(Article $article): RedirectResponse
    {
        return redirect()->route('article.show', $article->id);
    }

    public function create(): View
    {
        return view('admin.article.create')
            ->with('categories', Category::all())
            ->with('types', Type::all())
            ->with('age_limits', Article::age_limits())
            ->with('studios', Studio::all())
            ->with('genres', Genre::all())
            ->with('statuses', Article::statuses())
            ->with('countries', Country::all());
    }

    public function store(StoreRequest $request, ArticleService $articleService): RedirectResponse
    {
        $articleService->store($request);

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article): View
    {
        $article->genre_id = $article->genres;
        $article->studio_id = $article->studios;

        return view('admin.article.edit')
            ->with('article', $article)
            ->with('categories', Category::all())
            ->with('types', Type::all())
            ->with('age_limits', Article::age_limits())
            ->with('studios', Studio::all())
            ->with('genres', Genre::all())
            ->with('statuses', Article::statuses())
            ->with('countries', Country::all());
    }

    public function update(UpdateRequest $request, Article $article, ArticleService $articleService): RedirectResponse
    {
        $articleService->update($request, $article);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
//        Если не SoftDelete
//        $article->genres()->detach();
//        Storage::disk('articles')->delete($article->image);
        $article->delete();

        return redirect()->route('admin.articles.index');
    }

    public function drafts(): View
    {
        $articles = Article::query()
            ->status('DRAFT')
            ->orderByDesc('articles.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);

        return view('admin.article.index')->with('articles', $articles);
    }

    public function archive(): View
    {
        $articles = Article::query()
            ->status('ARCHIVE')
            ->orderByDesc('articles.id')
            ->paginate(Marena::COUNT_ADMIN_ITEMS);

        return view('admin.article.index')->with('articles', $articles);
    }
}
