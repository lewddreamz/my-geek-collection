<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enums\CollectionTypes;
use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(EntryRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discr')]
#[DiscriminatorMap([
    'film' => FilmEntry::class,
    'game' => GameEntry::class,
    'book' => BookEntry::class,
])]
class Entry implements EntryInterface
{
    use FillableTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(enumType: CollectionTypes::class)]
    #[Assert\NotBlank()]
    #[Assert\Choice(callback: [CollectionTypes::class, 'cases'])]
    protected CollectionTypes $entryType;
    #[ORM\Column]
    #[Context([DateTimeNormalizer::FORMAT_KEY => \DateTime::RFC3339])]
    #[Assert\NotBlank()]
    protected \DateTimeImmutable $createdAt;
    #[ORM\ManyToOne(Collection::class, inversedBy: 'entries')]
    protected Collection $collection;
    #[Assert\NotBlank]
    protected ?EntryDataObject $edo;
    public function data(): EntryDataObject
    {
        return $this->edo;
    }
//    public function getTitle(): ?string
//    {
////        if ($this->edo ?? null) {
////            return $this->edo->getTitle();
////        }
////        return null;
//        return $this->edo->getTitle();
//    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCollection(): Collection
    {
        return $this->collection;
    }

    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }

    public function getEntryType(): CollectionTypes
    {
        return $this->entryType;
    }
}
