<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'articles';
    protected $guarded = false;
    protected $with = ['articleExtended', 'type'];
//    protected $withCount = ['comments'];

    public static function statuses(): \Illuminate\Support\Collection
    {
        return collect(['PUBLISHED', 'DRAFT', 'ARCHIVE', 'DELETED']);
    }

    public function scopeStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    public static function age_limits(): \Illuminate\Support\Collection
    {
        return collect(['0+', '6+', '12+', '16+', '18+']);
    }

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

    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function articleExtended()
    {
        return $this->hasOne(ArticleExtended::class);
    }

    public function comments()
    {
        return $this->morphMany(Comments::class, 'commentable');
    }

}
