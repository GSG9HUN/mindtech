<?php

namespace App\Console\Commands;

use App\Repository\DirectorMovieRepository;
use App\Repository\DirectorRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieGenreRepository;
use App\Repository\MovieRepository;
use Illuminate\Console\Command;
use TMDBClient\MindTechApps\TMDBClient;

class RefreshTopRatedMovieData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tmdb:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Top Rated Movies Data from TMDB.';

    /**
     * Execute the console command.
     *
     * @param GenreRepository $genreRepository
     * @param MovieRepository $movieRepository
     * @param MovieGenreRepository $movieGenreRepository
     * @param DirectorRepository $directorRepository
     * @param DirectorMovieRepository $directorMovieRepository
     * @return int
     */
    public function handle(GenreRepository $genreRepository, MovieRepository $movieRepository, MovieGenreRepository $movieGenreRepository, DirectorRepository $directorRepository, DirectorMovieRepository $directorMovieRepository): string
    {
        $tmdbClient = new TMDBClient();

        $movieGenreRepository->deleteAll();
        $directorMovieRepository->deleteAll();
        $directorRepository->deleteAll();
        $genreRepository->deleteAll();
        $movieRepository->deleteAll();

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
        return Command::SUCCESS;
    }
}
