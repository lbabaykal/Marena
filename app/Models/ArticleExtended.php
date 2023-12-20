<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleExtended extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'article_extended';
    protected $guarded = false;
    public $timestamps = false;
    protected $withCount = ['ratings'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'article_id', 'article_id');
    }
}
