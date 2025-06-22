<?php

declare(strict_types=1);

namespace App\Service\Api\Tmdb;

use App\Service\Api\ApiInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TmdbApi implements ApiInterface
{
    private string $baseUrl = 'https://api.themoviedb.org';
    private string $accessToken = '9b59eeaf415a933eced065d87c116e90';

    public function __construct(private HttpClientInterface $httpClient, private TmdbApiFactory $factory)
    {
        $this->httpClient = $this->httpClient->withOptions(
            (new HttpOptions())
            ->setBaseUri($this->baseUrl)
            ->toArray()
        );
    }

    public function findByTitle(string $title): ArrayCollection
    {
        $response = $this->httpClient->request('GET',
            '3/search/movie',
            ['query' => ['query' => $title,
                'api_key' => $this->accessToken]]);

        return $this->factory->createFilmsFromSearchMovieResponse($response);
    }
}
