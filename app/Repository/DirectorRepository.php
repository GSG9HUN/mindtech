<?php

namespace App\Repository;

use App\Models\Director;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DirectorRepository
{
    public function create($director): void
    {
        $newDirector = new Director();
        $newDirector->name = $director->name;
        $newDirector->tmdb_id = $director->id;
        $newDirector->biography = $director->biography;
        $newDirector->date_of_birth = $director->birthday;
        $newDirector->save();
    }

    public function deleteAll(): void
    {
        Director::query()->delete();
    }

    public function find(int $directorID): Builder|Model|null
    {
        return Director::query()->where('tmdb_id', $directorID)->first();
    }
}
