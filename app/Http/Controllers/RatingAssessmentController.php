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
            $data['user_id'] = Auth::id();
            if ($ratingAssessment::where('user_id',$data['user_id'])
                                        ->where('article_id', $data['article_id'])
                                        ->exists())
            {
                $ratingAssessment->where('user_id', $data['user_id'])
                                        ->where('article_id', $data['article_id'])
                                        ->update( ['assessment'=> $data['assessment']] );
                return ['success' => 'Yess'];
            } else {
                $ratingAssessment->create($data);
                return ['success' => 'Yes'];
            }

        } else  {
            return ['success' => 'No'];
        }
    }
}
