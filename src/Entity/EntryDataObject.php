<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Validator\Constraints as Assert;

#[MappedSuperclass]
abstract class EntryDataObject
{
    use FillableTrait;
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue()]
    protected ?int $id;
    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank]
    protected string $title;
    #[ORM\Column(type: Types::ARRAY)]
    #[Assert\NotNull]
    protected array $genre;
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    #[Assert\NotBlank]
    #[Context([DateTimeNormalizer::FORMAT_KEY => \DateTimeInterface::RFC3339])]
    protected ?\DateTimeImmutable $createdAt;
    #[ORM\Column(type: Types::STRING)]
    #[Assert\NotBlank]
    protected ?string $author;


    /**
     * Get the value of author.
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author.
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of title.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title.
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of genre.
     */
    public function getGenre(): string|array
    {
        return $this->genre;
    }

    /**
     * Set the value of genre.
     */
    public function setGenre(string|array $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of createdAt.
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt.
     */
    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
