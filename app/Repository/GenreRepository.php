<?php

namespace App\Repository;

use App\Models\Genre;

class GenreRepository
{
    public function saveAll($genres): void
    {
        foreach ($genres as $genre) {
            $newGenre = new Genre();
            $newGenre->id = $genre->id;
            $newGenre->name = $genre->name;
            $newGenre->save();
        }
    }

    public function deleteAll(): void
    {
        Genre::query()->delete();
    }
}
