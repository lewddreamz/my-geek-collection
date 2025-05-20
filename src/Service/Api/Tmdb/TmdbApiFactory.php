<?php

declare(strict_types=1);

namespace App\Service\Api\Tmdb;

use App\Entity\Entry;
use App\Service\Api\Tmdb\Responses\TmdbSearchMovieResponse;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TmdbApiFactory
{
    public function __construct(private LoggerInterface $logger, private ValidatorInterface $validator, private SerializerInterface $serializer)
    {
    }

    /**
     * @return ArrayCollection list<Films>
     *
     * @throws
     */
    public function createFilmsFromSearchMovieResponse(ResponseInterface $response): ArrayCollection
    {
        /**
         * @var $tmdbresponse TMDBSearchMovieResponse
         */
        $tmdbresponse = $this->serializer->deserialize($response->getContent(), TmdbSearchMovieResponse::class, 'json');
        $arr = new ArrayCollection();
        $this->logger->info('Creating films from Tmdb search movie');
        $this->logger->debug('Creating films from Tmdb search movie');
        foreach ($tmdbresponse->results as $result) {
            $film = new Entry();
            $metadata = [
                'title' => $result->title,
            ];
            $film->setMetadata($metadata);
            $film->setCreatedAt($result->release_date ? \DateTimeImmutable::createFromFormat('Y-m-d', $result->release_date) : null);
            $errors = $this->validator->validate($film);
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    $this->logger->error("{$error->getMessage()} ({$error->getPropertyPath()})");
                    $this->logger->error('Value of type '.gettype($error->getInvalidValue()).' given');
                }
            } else {
                $arr->add($film);
            }
        }

        return $arr;
    }
}
