<?php

namespace App\Http\Controllers;

use App\Marena;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function __invoke(): View
    {
        $articles_anime = Article::query()
            ->where('category_id', 1)
            ->where('is_show', 1)
            ->limit(Marena::COUNT_ARTICLES_MAIN)
            ->latest('updated_at')
            ->get();

        $articles_dorams = Article::query()
            ->where('category_id', 2)
            ->where('is_show', 1)
            ->limit(Marena::COUNT_ARTICLES_MAIN)
            ->latest('updated_at')
            ->get();

        return view('layouts.main.index')
            ->with('articles_anime', $articles_anime)
            ->with('articles_dorams', $articles_dorams);
    }
}
