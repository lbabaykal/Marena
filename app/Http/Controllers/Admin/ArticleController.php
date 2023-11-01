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
use App\Models\Rating;
use App\Models\Studio;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
                    ->with('studios', Studio::all())
                    ->with('genres', Genre::all())
                    ->with('countries', Country::all());
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $request->file('image')->store(date('Y-m'), 'images_articles');
        }

        $data['is_show'] = $request->boolean('is_show');
        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $data['genre_id'] = null;

        DB::beginTransaction();
            $article = Article::query()->create($data);
            Rating::query()->create([
                'article_id' => $article->id,
                'rating' => 0,
                'count_assessments' => 0
            ]);
        DB::commit();
        $article->genres()->attach($genres);

        return redirect()->route('admin.articles.index');
    }

    public function edit(Article $article): View
    {
        $article->genre_id =  $article->genres;

        return view('admin.article.edit')
            ->with('article', $article)
            ->with('categories', Category::all())
            ->with('types', Type::all())
            ->with('studios', Studio::all())
            ->with('genres', Genre::all())
            ->with('countries', Country::all());
    }

    public function update(UpdateRequest $request, Article $article): RedirectResponse
    {
        $data = $request->validated();
        if (isset($data['image']))
        {
            $data['image'] = $request->file('image')->store(date('Y-m'), 'images_articles');
            if ($article->image != 'no_image.png')
            {
                Storage::disk('images_articles')->delete($article->image);
            }
        }

        $data['is_show'] = $request->boolean('is_show');
        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $data['genre_id'] = null;

        $article->update($data);
        $article->genres()->sync($genres);

        return redirect()->route('admin.articles.index');
    }

    public function destroy(Article $article): RedirectResponse
    {
        //Если не SoftDelete
//        $article->genres()->detach();
//        if ($article->image !== 'no_image.png') Storage::disk('images_articles')->delete($article->image);
        $article->delete();
        return redirect()->route('admin.articles.index');
    }
}
