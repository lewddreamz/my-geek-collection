<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Component\Validator\Constraints\Valid;

#[Entity]
class GameEntry extends Entry
{
    #[ManyToOne(targetEntity: Game::class, cascade: ['persist'])]
    #[Valid()]
    private Game $game;
}
