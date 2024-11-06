<?php
declare(strict_types=1);
namespace App\Entity;
use App\Entity\Entry;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
#[Entity]
class BookEntry extends Entry
{
    #[ManyToOne(Book::class)]
    private Book $book;

    /**
     * Get the value of book
     */ 
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set the value of book
     *
     * @return  self
     */ 
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }
}