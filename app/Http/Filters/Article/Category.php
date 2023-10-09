<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Category extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->where(function (Builder $query) {
            foreach (request('category') as $item) {
                $query->orWhere('category_id', $item);
            }
        });
    }
}
