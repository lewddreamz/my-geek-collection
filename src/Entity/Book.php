<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\EntryDataObject;
use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(BookRepository::class)]
class Book extends EntryDataObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $pagesAmount;
}