<?php

namespace App\Http\Filters\Article;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class Title extends AbstractFilter
{
    public function applyFilter(Builder $builder)
    {
        $builder->where(function (Builder $query)
        {
            $query->where('title_orig', 'LIKE', '%' . request('title') . '%')
                    ->orWhere('title_rus', 'LIKE', '%' . request('title') . '%')
                    ->orWhere('title_eng', 'LIKE', '%' . request('title') . '%');
        });
    }
}
