<?php
declare(strict_types=1);
namespace App\Entity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
#[ORM\Entity(EntryRepository::class)]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn('discr')]
#[DiscriminatorMap([
    'film' => FilmEntry::class,
    'game' => GameEntry::class,
    'book' => BookEntry::class,
])]
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