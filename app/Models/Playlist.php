<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Playlist extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'playlists';
    protected $guarded = false;
    public $timestamps = false;

    public static function types(): \Illuminate\Support\Collection
    {
        return collect(['SUB', 'MVO', 'DUB']);
    }

}
