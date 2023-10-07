<?php

namespace App\Console\Commands;

use App\Models\Rating;
use App\Models\RatingAssessment;
use Illuminate\Console\Command;

class RatingUpdate extends Command
{

    protected $signature = 'rating-update';
    protected $description = 'Обновление рейтинга статей.';

    public function handle()
    {
        $ratingArticle = Rating::all();
        $ids = $ratingArticle->pluck('article_id');
        foreach ($ids as $id) {
            $articleRating = Rating::where('article_id', $id);
            $countRatingAssessment = RatingAssessment::where('article_id', $id)->count();
            $avgRatingAssessment = RatingAssessment::where('article_id', $id)->avg('assessment');

            $articleRating->update([
                'rating' => round($avgRatingAssessment, 1),
                'count_assessments' => $countRatingAssessment
            ]);
        }
        echo memory_get_usage() / 1014 / 1024;
        return 0;
    }
}
