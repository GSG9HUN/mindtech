<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = null;
    protected $table = 'movie';
    protected $fillable = ['title', 'release_date', 'overview', 'poster_url', 'tmdb_id', 'tmdb_vote_average', 'tmdb_vote_count', 'tmdb_url'];

    protected $primaryKey = 'tmdb_id';
}
