<?php

namespace App\Http\Controllers;

use App\Marena;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        $articlesCategory = Article::orderBy('id', 'desc')
            ->where('category_id', $category->id)
            ->where('is_show', 1)
            ->paginate(Marena::COUNT_ARTICLES_FULL);
        return view('main.categories', compact('articlesCategory'));
    }
}
