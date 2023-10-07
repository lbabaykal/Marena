<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __invoke(\App\Http\Requests\Admin\Comments\UpdateRequest $request, $commentId)
    {
        $data = $request->validated();
        $comment = Comments::find($commentId);

        if (Auth::check()) {
            if ($comment !== null) {
                $comment->update($data);
                return ['success' => 'Yes'];
            } else {
                return ['success' => 'No'];
            }
        } else  {
            return ['success' => 'No'];
        }
    }
}
