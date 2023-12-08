<?php

namespace App\Services;

use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\UpdateRequest;
use App\Models\Article;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    private string|null $image = null;

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request);
        }

        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $studios = $data['studio_id'] ?? null;
        unset($data['genre_id'], $data['studio_id']);

        try {
            DB::beginTransaction();

            $article = Article::query()->create($data);
            Rating::query()->create([
                'article_id' => $article->id,
                'rating' => 0,
                'count_assessments' => 0
            ]);
            $article->genres()->attach($genres);
            $article->studios()->attach($studios);

            DB::commit();
            return $article;

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.articles.index');
        }

    }

    public function update(UpdateRequest $request, Article $article)
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $this->saveImage($request);
            $this->image = $article->image ?? null;
        }

        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $studios = $data['studio_id'] ?? null;
        unset($data['genre_id'], $data['studio_id']);

        $article->update($data);
        $article->genres()->sync($genres);
        $article->studios()->sync($studios);

        $this->deleteImage();

        return $article;
    }

    public function saveImage(Request $request): bool|string
    {
        return $request->file('image')->store(date('Y-m'), 'articles');
    }

    public function deleteImage(): void
    {
        if (isset($this->image)) {
            Storage::disk('articles')->delete($this->image);
        }
    }

}
