<?php
declare(strict_types=1);
namespace App\Service\Api;
use App\Entity\EntryDataObject;
interface ApiFactoryInterface
{
    public function createEDO(array $data): EntryDataObject;
}