<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $table = 'episodes';
    protected $guarded = false;
    public $timestamps = false;

    public static function statuses(): \Illuminate\Support\Collection
    {
        return collect(['PUBLISHED', 'DRAFT', 'ERROR']);
    }

}
