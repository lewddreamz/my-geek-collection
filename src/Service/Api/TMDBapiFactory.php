<?php

declare(strict_types=1);

namespace App\Service\Api;

use App\Entity\EntryDataObject;
use App\Entity\Film;
use App\Service\Api\Responses\TMDBSearchMovieResponse;
use App\Service\Api\Responses\TMDBSearchMovieResult;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Log\LoggerInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class TMDBapiFactory implements ApiFactoryInterface
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
        /*
        $extractor = new PropertyInfoExtractor([], [new PhpDocExtractor(), new ReflectionExtractor()]);
        $normalizer = new ObjectNormalizer(propertyInfoExtractor: $extractor);
        $serializer = new Serializer([new ArrayDenormalizer(), $normalizer], [new JsonEncoder()]);
        */
        /**
         * @var $tmdbresponse TMDBSearchMovieResponse
         */
        $tmdbresponse = $this->serializer->deserialize($response->getContent(), TMDBSearchMovieResponse::class, 'json');
        $arr = new ArrayCollection();
        /**
         * @var $result TMDBSearchMovieResult
         */
        foreach ($tmdbresponse->results as $result) {
            $film = new Film();
            $film->setTitle($result->title);
            $film->setCreatedAt($result->release_date ? \DateTimeImmutable::createFromFormat('Y-m-d', $result->release_date) : null);
            $film->setAuthor('Author');
            $film->setDirector('Director');
            $film->setGenre($result->genre_ids);
            $errors = $this->validator->validate($film);
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                $this->logger->error("{$error->getMessage()} ({$error->getPropertyPath()})");
                $this->logger->error("Value of type " . gettype($error->getInvalidValue()) . "given");
                }
            } else {
                $arr->add($film);
            }
        }

        return $arr;
    }

    public function createEDO(array $data): EntryDataObject
    {
        // implement serializer?

        $ddata = [
            'title' => $data['title'],
            'genre' => $data['genre_ids'],
            'createdAt' => \DateTime::createFromFormat('Y-m-d', $data['release_date']) ?: null,
        ];
        // TODO switch between films, tv shows, anime etc
        $film = new Film();
        $film->fill($ddata);
        $this->validator->validate($film);

        return $film;
    }
}
