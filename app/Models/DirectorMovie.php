<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectorMovie extends Model
{
    use HasFactory;

    public $timestamps = null;
    protected $table = 'director_movie';
    protected $fillable = ['movie_id', 'director_id'];
}
