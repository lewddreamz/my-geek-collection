<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\Entry;
use Doctrine\ORM\Mapping\ManyToOne;
class BookEntry extends Entry
{
    #[ManyToOne(Book::class)]
    private Book $book;
}