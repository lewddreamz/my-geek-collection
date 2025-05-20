<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enums\CollectionTypes;
use App\Repository\EntryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(EntryRepository::class)]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(nullable: true, enumType: CollectionTypes::class)]
    #[Assert\Choice(callback: [CollectionTypes::class, 'cases'])]
    protected ?CollectionTypes $entryType = null;
    #[ORM\Column]
    #[Context([DateTimeNormalizer::FORMAT_KEY => \DateTimeInterface::RFC3339])]
    #[Assert\NotBlank()]
    protected \DateTimeImmutable $createdAt;
    #[ORM\ManyToOne(Collection::class, inversedBy: 'entries')]
    protected Collection $collection;
    #[ORM\Column(type: Types::JSON, options: ['jsonb' => true])]
    protected array $metadata;

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

    public function setEntryType(?CollectionTypes $entryType): void
    {
        $this->entryType = $entryType;
    }

    public function getEntryType(): ?CollectionTypes
    {
        return $this->entryType;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): void
    {
        $this->metadata = $metadata;
    }
}
