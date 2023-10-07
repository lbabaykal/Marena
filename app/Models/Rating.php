<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'ratings';
    protected $guarded = false;
    public $timestamps = false;

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
