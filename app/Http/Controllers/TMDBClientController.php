<?php

namespace App\Http\Controllers;

use App\Repository\DirectorMovieRepository;
use App\Repository\DirectorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieGenreRepository;
use App\Repository\MovieRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use TMDBClient\MindTechApps\TMDBClient;

class TMDBClientController extends Controller
{
    public function index(GenreRepository $genreRepository, MovieRepository $movieRepository, MovieGenreRepository $movieGenreRepository, DirectorRepository $directorRepository, DirectorMovieRepository $directorMovieRepository)
    {
        $tmdbClient = new TMDBClient();

        //egy event

        $movieGenreRepository->deleteAll();
        $directorMovieRepository->deleteAll();
        $directorRepository->deleteAll();
        $genreRepository->deleteAll();
        $movieRepository->deleteAll();


// másik event

        $genres = $tmdbClient->getGenres();
        $genreRepository->saveAll($genres);


        $movies = $tmdbClient->getTopRatedMovies();

        foreach ($movies as $movie) {
            $movieRepository->create($movie);
            $movieGenreRepository->createAll($movie->id, $movie->genre_ids);
            $directors = $tmdbClient->getDirectors($movie->id);
            foreach ($directors as $director) {
                $details = $tmdbClient->getDirectorDetails($director->id);
                $existingDirector = $directorRepository->find($director->id);
                if ($existingDirector) {
                    $directorMovieRepository->create($movie->id, $existingDirector->tmdb_id);
                    continue;
                }
                $directorRepository->create($details);

                $directorMovieRepository->create($movie->id, $details->id);
            }
        }

    }
}
