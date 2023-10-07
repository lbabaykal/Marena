<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'genres';
    protected $guarded = false;
    public $timestamps = false;

    public function articles()
    {
//        return $this->belongsToMany(Article::class, 'article_genre', 'genre_id', 'article_id');
        return $this->belongsToMany(Article::class);
    }

}
