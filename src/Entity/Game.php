<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\EntryDataObject;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(GameRepository::class)]
class Game extends EntryDataObject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(type: Types::STRING)]
    private string $publisher;
}