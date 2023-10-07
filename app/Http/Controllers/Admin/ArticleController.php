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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::orderBY('id', 'DESC')->paginate(Marena::COUNT_ADMIN_ITEMS);
        return view('admin.article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return redirect()->route('article.show', $article->id);
    }

    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        $studios = Studio::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('admin.article.create', compact('categories', 'types', 'studios', 'genres', 'countries'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            $data['image'] = $request->file('image')->store(date('Y-m'), 'images_articles');
        }
        $data['is_show'] = isset($data['is_show']);
        $data['is_comment'] = isset($data['is_comment']);
        $data['is_rating'] = isset($data['is_rating']);
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $data['genre_id'] = null;

        DB::beginTransaction();
        $article = Article::create($data);
        Rating::create([
            'article_id' => $article->id,
            'rating' => 0,
            'count_assessments' => 0
        ]);
        DB::commit();
        $article->genres()->attach($genres);

        return redirect(route('admin.articles.index'));
    }

    public function edit(Article $article)
    {
        $article->genre_id =  $article->genres;
        $categories = Category::all();
        $types = Type::all();
        $studios = Studio::all();
        $countries = Country::all();
        $genres = Genre::all();
        return view('admin.article.edit', compact('article', 'categories', 'types', 'studios', 'genres', 'countries'));
    }

    public function update(UpdateRequest $request, Article $article)
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
        $data['is_show'] = isset($data['is_show']);
        $data['is_comment'] = isset($data['is_comment']);
        $data['is_rating'] = isset($data['is_rating']);
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $data['genre_id'] = null;

        $article->update($data);
        $article->genres()->sync($genres);

        return redirect(route('admin.articles.index'));
    }

    public function destroy(Article $article)
    {
        //Если не SoftDelete
//        $article->genres()->detach();
//        if ($article->image !== 'no_image.png') Storage::disk('images_articles')->delete($article->image);
        $article->delete();
        return redirect(route('admin.articles.index'));
    }
}
