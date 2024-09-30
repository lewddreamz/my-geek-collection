<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\EntryDataObject;
use App\Repository\FilmRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(FilmRepository::class)]
class Film extends EntryDataObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(Types::STRING)]
    private string $director;
}