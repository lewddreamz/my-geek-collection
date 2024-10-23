<?php
declare(strict_types=1);
namespace App\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
class GameEntry extends Entry
{
    #[ManyToOne(targetEntity: Game::class)]
    private Game $game;
}