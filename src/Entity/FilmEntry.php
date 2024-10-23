<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\Entry;
use Doctrine\ORM\Mapping\ManyToOne;
class FilmEntry extends Entry
{
    #[ManyToOne(Film::class)]
    private Film $film;
}