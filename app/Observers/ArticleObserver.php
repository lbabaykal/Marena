<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    public function created(Article $article): void
    {
        $article->articleExtended()->create([
            'rating' => 0,
            'count_assessments' => 0
        ]);
    }
    public function updating(Article $article): void
    {
        if ($article->isDirty('image') && $article->getOriginal('image')) {
            Storage::disk('articles')->delete($article->getOriginal('image'));
            Storage::disk('articles_preview')->delete($article->getOriginal('image'));
        }
    }

    public function deleted(Article $article): void
    {
        Storage::disk('articles')->delete($article->image);
        Storage::disk('articles_preview')->delete($article->image);
    }
}
