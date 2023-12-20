<?php

namespace App\Console\Commands;

use App\Models\ArticleExtended;
use Illuminate\Console\Command;

class RatingUpdate extends Command
{

    protected $signature = 'rating-update';
    protected $description = 'Обновление рейтинга статей.';

    public function handle()
    {

//        Rating::query()->chunk(100, function ($ratings) {
//            foreach ($ratings as $rating) {
//                $rating->rating = round($rating->rating_assessments()->avg('assessment'), 1);
//                $rating->count_assessments = $rating->rating_assessments_count;
//                $rating->save();
//            }
//        });

        foreach (ArticleExtended::cursor() as $rating) {
            $rating->rating = round($rating->ratings()->avg('assessment'), 1);
            $rating->count_assessments = $rating->ratings_count;
            $rating->save();
        }

        echo 'Рейтинг обновлён - ' . memory_get_usage() / 1014 / 1024 . ' mb';
    }
}
