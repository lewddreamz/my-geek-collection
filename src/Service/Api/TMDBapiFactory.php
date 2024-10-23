<?php
declare(strict_types=1);
namespace App\Service\Api;
use App\Entity\EntryDataObject;
use App\Entity\Film;
use Psr\Log\LoggerInterface;

class TMDBapiFactory implements ApiFactoryInterface
{
    public function __construct(private LoggerInterface $logger) {}
    public function createEDO(array $data): EntryDataObject
    {
        $this->logger->debug('Search result');
        $this->logger->debug(print_r($data,true));
        $ddata = [
            'title' => $data['title'],
            'genre' => $data['genre_ids'],
            'createdAt' => \DateTime::createFromFormat('Y-m-d', $data['release_date']) ?: null,
        ];
        #TODO switch between films, tv shows, anime etc
        $film = new Film();
        $film->fill($ddata);
        return $film;
    }
}