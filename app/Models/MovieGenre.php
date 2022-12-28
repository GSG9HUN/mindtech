<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    use HasFactory;

    public $timestamps = null;
    protected $table = 'movie_genre';
    protected $fillable = ['movie_id', 'genre_id'];
}
