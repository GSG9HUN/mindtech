<?php

namespace App\Repository;

use App\Models\Movie;

class MovieRepository
{
    public function create($movie): void
    {
        $newMovie = new Movie();
        $newMovie->title = $movie->title;
        $newMovie->release_date = $movie->release_date;
        $newMovie->overview = $movie->overview;
        $newMovie->poster_url = $movie->poster_path;
        $newMovie->tmdb_id = $movie->id;
        $newMovie->tmdb_vote_average = $movie->vote_average;
        $newMovie->tmdb_vote_count = $movie->vote_count;
        $newMovie->tmdb_url = "https://www.themoviedb.org/movie/" . $movie->id;

        $newMovie->save();
    }

    public function deleteAll(): void
    {
        Movie::query()->delete();
    }
}
