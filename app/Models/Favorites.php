<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $guarded = false;
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'favorites', 'id', 'article_id');
    }
}
