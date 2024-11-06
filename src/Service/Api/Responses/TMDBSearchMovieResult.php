<?php

namespace App\Service\Api\Responses;

readonly class TMDBSearchMovieResult
{
    public function __construct(
        public bool $adult,
        public ?string $backdrop_path,
        /**
         * List<int>.
         */
        public array $genre_ids,
        public int $id,
        public string $original_language,
        public string $original_title,
        public string $overview,
        public float $popularity,
        public ?string $poster_path,
        public string $release_date,
        public string $title,
        public bool $video,
        public float $vote_average,
        public int $vote_count,
    ) {
    }
}
