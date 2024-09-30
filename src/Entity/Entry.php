<?php
declare(strict_types=1);
namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(EntryRepository::class)]
class Entry
{
    #[ORM\Id]
    #[ORM\GeneratedValue()]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column]
    private string $entryType;
    #[ORM\Column]
    private \DateTimeImmutable $createdAt;
    #[ORM\ManyToOne(EntryDataObject::class)]
    private EntryDataObject $entryData;
    #[ORM\ManyToOne(Collection::class)]
    private Collection $collection;
    public function __construct(string $entryType)
    {
        $interfaces = class_implements($entryType);
        if (!in_array(EntryDataObject::class, $interfaces)) {
            throw new \InvalidArgumentException("$entryType MUST BE a class extending \App\Entity\EntryDataObject");
        }
        $this->entryType = $entryType;
    }
}