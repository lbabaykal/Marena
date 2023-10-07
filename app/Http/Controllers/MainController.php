<?php

namespace App\Http\Controllers;

use App\Marena;
use App\Models\Article;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __invoke()
    {
        $articles_anime = Article::orderByDesc('articles.id')
                                    ->where('category_id', 1)
                                    ->where('is_show', 1)
                                    ->limit(Marena::COUNT_ARTICLES_MAIN)
                                    ->get();
        $articles_dorams = Article::orderByDesc('articles.id')
                                    ->where('category_id', 2)
                                    ->where('is_show', 1)
                                    ->limit(Marena::COUNT_ARTICLES_MAIN)
                                    ->get();
        $articles_manga = Article::orderByDesc('articles.id')
                                    ->where('category_id', 3)
                                    ->where('is_show', 1)
                                    ->limit(Marena::COUNT_ARTICLES_MAIN)
                                    ->get();

        return view('main.index', compact('articles_anime', 'articles_dorams', 'articles_manga'));
    }
}