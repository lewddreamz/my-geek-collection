<?php
declare(strict_types=1);
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;
#[MappedSuperclass]
abstract class EntryDataObject
{
    use FillableTrait;
    #[ORM\Id]
    #[ORM\Column]
    #[ORM\GeneratedValue()]
    protected ?int $id;
    #[ORM\Column(type:Types::STRING)]
    protected string $title;
    #[ORM\Column(type:Types::STRING)]
    protected array|string $genre;
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    protected ?\DateTimeInterface $createdAt;
    #[ORM\Column(type:Types::STRING)]
    protected ?string $author;

    /**
     * Get the value of author
     *
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @param string $author
     *
     * @return self
     */
    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of genre
     *
     * @return string|array
     */
    public function getGenre(): string|array
    {
        return $this->genre;
    }

    /**
     * Set the value of genre
     *
     * @param array|string $genre
     *
     * @return self
     */
    public function setGenre(string|array $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return self
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}