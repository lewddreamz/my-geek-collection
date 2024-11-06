<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\Entry;
use App\Enums\CollectionTypes;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;
#[Entity]
class FilmEntry extends Entry
{
    #[ManyToOne(Film::class, ['persist'], fetch: 'EAGER')]
    #[Type(Film::class)]
    #[Valid()]
    protected Film $film;
    protected CollectionTypes $entryType = CollectionTypes::Film;

    public function __construct()
    {
    }

    public function data(): Film
    {
        return $this->film;
    }
    /**
     * Get the value of film
     *
     * @return Film
     */
    public function getFilm(): Film
    {
        return $this->film;
    }

    /**
     * Set the value of film
     *
     * @param Film $film
     *
     * @return self
     */
    public function setFilm(Film $film): self
    {
        $this->film = $this->edo = $film;
        return $this;
    }
}