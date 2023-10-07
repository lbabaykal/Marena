<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditController extends Controller
{
    public function __invoke($comment)
    {
        $comment = Comments::find($comment);
        if (Auth::check()) {
            if ($comment->user_id == Auth::id()) {
                return view('main.comments.edit', compact('comment'));
            } else {
                return ['success' => 'No'];
            }
        } else  {
            return ['success' => 'No'];
        }
    }
}
