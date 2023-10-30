<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function show(Folder $folder)
    {
        if ($folder->user_id !== Auth::id() && $folder->user_id != null && $folder->isPublic != true) {
            return redirect()->route('account.favorites.index');
        }

        $folder['articles'] = Favorites::query()
            ->where('folder_id', $folder->id)
            ->where('user_id', Auth::id())
            ->get();

        return view('account.folder')->with('folder', $folder);
    }

}
