<?php

namespace App\Services;

use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\UpdateRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;

class ArticleService
{
    public function store(StoreRequest $request)
    {
        $fileName = $this->uploadImage($request);

        $data = $request->validated();
        $data['image'] = $fileName;
        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $studios = $data['studio_id'] ?? null;
        unset($data['genre_id'], $data['studio_id']);

        try {
            DB::beginTransaction();

            $article = Article::query()->create($data);
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
        $fileName = $this->uploadImage($request);

        $data = $request->validated();
        $data['image'] = $fileName ?? $article->image;
        $data['is_comment'] = $request->boolean('is_comment');
        $data['is_rating'] = $request->boolean('is_rating');
        $data['author_id'] = Auth::id();
        $genres = $data['genre_id'] ?? null;
        $studios = $data['studio_id'] ?? null;
        unset($data['genre_id'], $data['studio_id']);

        $article->update($data);
        $article->genres()->sync($genres);
        $article->studios()->sync($studios);

        return $article;
    }

    private function uploadImage(StoreRequest|UpdateRequest $request): string|null
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $fileName = date('Y-m') . '/' . Str::random(40) . '.webp';

        $imageArticle = ImageManager::gd()
            ->read($request->file('image'))
            ->toWebp(100)
            ->toFilePointer();

        $imageArticlePreview = ImageManager::gd()
            ->read($request->file('image'))
            ->scale(width: 252)
            ->toWebp(100)
            ->toFilePointer();

        Storage::disk('articles')->put($fileName, $imageArticle);
        Storage::disk('articles_preview')->put($fileName, $imageArticlePreview);

        return $fileName;
    }

}
