<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class YearTo extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->whereYear('release', '<=', request('year_to'));
    }
}
