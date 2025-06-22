<?php

namespace App\Service\Api\Tmdb\Responses;

readonly class TmdbSearchMovieResponse
{
    public function __construct(public int $page,
        /**
         * @var TmdbSearchMovieResponseResult[] List<TMDBSearchMovieResult>
         */
        public array $results,
        public int $total_results,
        public int $total_pages,
    ) {
    }
}
