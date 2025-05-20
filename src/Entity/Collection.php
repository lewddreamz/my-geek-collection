<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enums\CollectionTypes;
use App\Repository\CollectionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(CollectionRepository::class)]
class Collection
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $name;

    #[ORM\ManyToOne(Collection::class, inversedBy: 'subcollections')]
    private ?Collection $parent;

    #[ORM\Column(type: Types::TEXT, enumType: CollectionTypes::class)]
    /**
     * Type of collection's entries.
     */
    private CollectionTypes $type;
    #[ORM\OneToMany(Collection::class, 'parent')]
    /**
     * List of subcollections.
     *
     * @var list<Collection>
     */
    private PersistentCollection $subcollections;

    #[ORM\OneToMany(Entry::class, mappedBy: 'collection', cascade: ['remove'], orphanRemoval: true)]
    private PersistentCollection $entries;

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the value of id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of parent.
     */
    public function getParent(): ?Collection
    {
        return $this->parent;
    }

    /**
     * Set the value of parent.
     */
    public function setParent(?Collection $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the value of entries.
     */
    public function getEntries(): PersistentCollection
    {
        return $this->entries;
    }

    /**
     * Set the value of name.
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): CollectionTypes
    {
        return $this->type;
    }

    public function setType(CollectionTypes $type): void
    {
        $this->type = $type;
    }
}
