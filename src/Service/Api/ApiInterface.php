<?php

declare(strict_types=1);

namespace App\Service\Api;

use Doctrine\Common\Collections\ArrayCollection;

interface ApiInterface
{
    public function findByTitle(string $title): ArrayCollection;
}
