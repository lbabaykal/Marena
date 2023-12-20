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

    public function genres()
    {
        return $this->belongsToMany(Genre::class,
            'article_genre',
            'article_genre.article_id',
            'article_genre.genre_id',
            'favorites.article_id');
    }

}
