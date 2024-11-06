<?php

namespace App\Service\Api\Responses;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;

readonly class TMDBSearchMovieResponse
{
    //public ArrayCollection $results;
    public function __construct(public int $page,
        /**
         * @var TMDBSearchMovieResult[] List<TMDBSearchMovieResult>
         */
        //#[Context(denormalizationContext: ArrayDenormalizer::)]
        public array $results,
        public int $total_results,
        public int $total_pages,
    ) {
        //$this->results = new ArrayCollection($results);
    }
}
