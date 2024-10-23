<?php
declare(strict_types=1);
namespace App\Service\Api;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\Api\TMDBapiFactory;
use Symfony\Component\HttpClient\HttpOptions;
use Symfony\Component\HttpClient\ScopingHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
class TMDBapi implements ApiInterface
{
    private string $baseUrl = 'https://api.themoviedb.org';
    private string $accessToken = '9b59eeaf415a933eced065d87c116e90';
    public function __construct(private HttpClientInterface $httpClient, private TMDBapiFactory $factory)
    {
        $this->httpClient = $this->httpClient->withOptions(
            (new HttpOptions())
            ->setBaseUri($this->baseUrl)
            ->toArray()
        );
    }
    public function findByTitle(string $title): ArrayCollection
    {
        $response = $this->httpClient->request("GET",
                                        '3/search/movie',
                                        ['query' => ['query' => $title,
                                                'api_key' => $this->accessToken]]);
        $results = $response->toArray();
        $elements = [];
        if (!empty($results) && !empty($results['results'])) {
            foreach ($results['results'] as $entry) {
                $elements[] = $this->factory->createEDO($entry);
            }
        }
        $collection = new ArrayCollection($elements);
        return $collection;
    }
}