<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Genre extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        if (request('genre_and_or')) {
            //AND
            $builder->where(function (Builder $query) {
                foreach (request('genre') as $item) {
                    $query->whereHas('genres', function (Builder $query) use ($item) {
                        $query->where('genre_id', $item);
                    });
                }
            });
        } else {
            //OR
            $builder->whereHas('genres', function (Builder $query) {
                $query->whereIn('genre_id', request('genre'));
            });
        }
    }
}
