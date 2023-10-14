<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folders';
    protected $guarded = false;
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'folders', 'id', 'user_id');
    }

    public static function findUserFolders(int $id)
    {
        return Folder::where('user_id', $id)->orWhere('user_id', 0)->get();
    }
}
