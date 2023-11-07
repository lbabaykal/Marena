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
    protected $with = ['rating', 'type'];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

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

    public function rating_assessments()
    {
        return $this->belongsToMany(User::class, 'rating_assessments', 'article_id', 'user_id');
    }

}
