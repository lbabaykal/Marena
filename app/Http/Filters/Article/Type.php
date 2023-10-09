<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Type extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->where(function (Builder $query) {
            foreach (request('type') as $item) {
                $query->orWhere('type_id', $item);
            }
        });
    }
}
