<?php

namespace TMDBClient\MindTechApps;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;

class TMDBClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/'
        ]);
    }

    public function getTopRatedMovies(): array|JsonResponse
    {
        try {
            $results = array();
            for ($i = 1; $i <= 11; $i++) {
                $res = $this->client->request('GET', 'movie/top_rated?api_key=' . config('tmdbclient.TMDB_API_KEY') . "&page=" . $i);
                $contents = json_decode($res->getBody()->getContents());
                $results = array_merge($results, $contents->results);
            }
            return array_slice($results, 0, 210);
        } catch (GuzzleException $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getGenres(): array|JsonResponse
    {
        try {
            $res = $this->client->request('GET', 'genre/movie/list?api_key=' . config('tmdbclient.TMDB_API_KEY'));
            return json_decode($res->getBody()->getContents())->genres;
        } catch (GuzzleException $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDirectors(int $movieID): array|JsonResponse
    {
        try {
            $res = $this->client->request('GET', 'movie/' . $movieID . '/credits?api_key=' . config('tmdbclient.TMDB_API_KEY'));
            $contents = $res->getBody()->getContents();
            $crews = json_decode($contents)->crew;
            $directors = array();
            foreach ($crews as $crew) {
                if ($crew->job == 'Director') {
                    $directors[] = $crew;
                }
            }
            return $directors;
        } catch (GuzzleException $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDirectorDetails(int $directorID)
    {
        try {
            $res = $this->client->request('GET', 'person/' . $directorID . '?api_key=' . config('tmdbclient.TMDB_API_KEY'));
            return json_decode($res->getBody()->getContents());
        } catch (GuzzleException $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
