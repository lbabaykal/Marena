<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingAssessment extends Model
{
    use HasFactory;
    protected $table = 'rating_assessments';
    protected $guarded = false;
    public $timestamps = false;

}
