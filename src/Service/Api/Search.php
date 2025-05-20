<?php
declare(strict_types=1);
namespace App\Service\Api;
use App\Service\Api\Tmdb\TmdbApi;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Psr\Container\ContainerInterface;
class Search implements ServiceSubscriberInterface
{
    /**
     * @property array<string,string> $apiMap
     */
    private array $apiMap;
    private ApiInterface $currentApi;

    public function __construct(
        private ContainerInterface $locator
    ) {}

    public static function getSubscribedServices():array
    {
        return [
            'tmdb' => TmdbApi::class
        ];
    }
    

    public function setApi(string $api): void
    {
        if ($this->locator->has($api)) {
            $this->currentApi = $this->locator->get($api);
        } else {
            throw new \InvalidArgumentException("Cant use $api as service name");
        }
    }
    public function findByTitle(string $title): ArrayCollection
    {
        return $this->currentApi->findByTitle($title);
    }
}