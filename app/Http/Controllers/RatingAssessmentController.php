<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingAssessmentRequest;
use App\Models\RatingAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingAssessmentController extends Controller
{
    public function __invoke(RatingAssessmentRequest $request, RatingAssessment $ratingAssessment)
    {
        if (Auth::check())
        {
            $data = $request->validated();
            RatingAssessment::query()->updateOrCreate(
                ['user_id' => Auth::id(), 'article_id' => $data['article_id']],
                ['assessment' => $data['assessment']]
            );

            return response()->json([
                'status' => 'success',
                'text' => 'Оценка добавлена/обновлена.',
            ]);
        } else {
            return response()->json([
                'status' => 'warning',
                'text' => 'Необходимо авторизоваться!',
            ]);
        }
    }
}
