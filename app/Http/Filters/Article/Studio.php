<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Studio extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        //OR
        $builder->whereHas('studios', function (Builder $query) {
            $query->whereIn('studio_id', request('studio'));
        });
    }
}
