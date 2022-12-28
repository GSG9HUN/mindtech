<?php

namespace App\Repository;

use App\Models\DirectorMovie;

class DirectorMovieRepository
{
    public function create(int $movieID, int $directorID): void
    {
        $directorMovie = new DirectorMovie();
        $directorMovie->movie_id = $movieID;
        $directorMovie->director_id = $directorID;

        $directorMovie->save();
    }

    public function deleteAll(): void
    {
        DirectorMovie::query()->delete();
    }
}
