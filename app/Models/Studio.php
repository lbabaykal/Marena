<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'studios';
    protected $guarded = false;
    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
