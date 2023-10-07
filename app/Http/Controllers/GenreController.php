<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __invoke(Genre $genre)
    {
        $articlesGenre = Article::all()->where('genre_id', $genre->id);
        return view('main.genres', compact('articlesGenre'));
    }
}
