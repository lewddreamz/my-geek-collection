<?php
declare(strict_types=1);
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection as DoctrineCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
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

    #[ORM\Column(type: Types::TEXT)]
    /**
     * EntryDataObject subclass
     * @var EntryDataObject::class string
     */
    private string $entryType;
    
    /**
     * @property list<EntryDataObject> $objects
     */

    #[ORM\OneToMany(Collection::class, 'parent')]
    /**
     * List of subcollections
     * @var list<Collection> $subcollections
     */
    private ArrayCollection $subcollections;
        
}