<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    public function store(RatingRequest $request): JsonResponse
    {
        if (Auth::check())
        {
            $data = $request->validated();
            \auth()->user()->ratings()->updateOrCreate(
                ['article_id' => $data['article_id']],
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

    public function destroy(RatingRequest $request): JsonResponse
    {
        if (Auth::check()) {
            $data = $request->validated();

            \auth()->user()->ratings()->where($data)->delete();

            return response()->json([
                'status' => 'success',
                'text' => 'Оценка удалена!',
            ]);
        } else  {
            return response()->json([
                'status' => 'warning',
                'text' => 'Необходимо авторизоваться!',
            ]);
        }
    }

}
