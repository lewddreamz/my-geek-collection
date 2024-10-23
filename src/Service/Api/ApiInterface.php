<?php
declare(strict_types=1);
namespace App\Service\Api;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Contracts\HttpClient\HttpClientInterface;
interface ApiInterface
{
        public function findByTitle(string $title): ArrayCollection;
}