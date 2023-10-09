<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class YearFrom extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->where('year', '>=', request('year_from'));
    }
}
