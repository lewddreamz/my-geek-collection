<?php

namespace App\Entity;

interface EntryInterface
{
    public function data(): EntryDataObject;
}