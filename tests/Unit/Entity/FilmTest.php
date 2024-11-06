<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Film;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FilmTest extends TestCase
{
    public function testSerialize()
    {
        $film = new Film();
        $film->setTitle('Vlastelin Kolec');
        $film->setCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', '2020-01-01')->setTimezone(new \DateTimeZone('Europe/Moscow')));
        //$film->setNotCreatedAt(\DateTimeImmutable::createFromFormat('Y-m-d', '2020-01-01'));
        $serializer = new Serializer(
            [new DateTimeNormalizer(), new ObjectNormalizer(propertyTypeExtractor: new ReflectionExtractor())],
            [new JsonEncoder()]);
        $serialized = $serializer->serialize($film, 'json', [[DateTimeNormalizer::FORMAT_KEY => \DateTime::RFC3339]]);
        $this->assertJson($serialized);
        //print_r($serialized);
        $deserialized = $serializer->deserialize($serialized, Film::class, 'json');
        //$this->assertSame($film, $deserialized);
        var_dump($deserialized);
    }
}
