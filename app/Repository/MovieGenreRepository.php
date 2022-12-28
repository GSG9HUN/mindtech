<?php

namespace App\Repository;

use App\Models\MovieGenre;

class MovieGenreRepository
{
    public function createAll(int $movieID, array $genreIDs): void
    {
        foreach ($genreIDs as $genreID) {
            $movieGenre = new MovieGenre();
            $movieGenre->movie_id = $movieID;
            $movieGenre->genre_id = $genreID;
            $movieGenre->save();
        }
    }

    public function deleteAll(): void
    {
        MovieGenre::query()->delete();
    }
}
