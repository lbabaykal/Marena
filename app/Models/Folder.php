<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $guarded = false;
    public $timestamps = false;
    protected $withCount = ['articles'];

    public function articles()
    {
        return $this->hasManyThrough(Article::class, Favorites::class, 'folder_id', 'id', 'id', 'article_id')
            ->where('user_id', Auth::id());
    }
}
