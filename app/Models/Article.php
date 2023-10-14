<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles';
    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites', 'article_id', 'user_id');
    }

    public function rating_assessments()
    {
        return $this->belongsToMany(User::class, 'rating_assessments', 'article_id', 'user_id');
    }

    public function folders()
    {
        return $this->belongsToMany(User::class, 'folders', 'article_id', 'user_id');
    }
}
