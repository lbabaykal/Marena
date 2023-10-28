<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Country extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->where(function (Builder $query) {
            foreach (request('country') as $item) {
                $query->orWhere('country_id', $item);
            }
        });
    }
}
