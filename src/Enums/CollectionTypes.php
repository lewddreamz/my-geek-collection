<?php
declare(strict_types=1);
namespace App\Enums;
enum CollectionTypes: string
{
    case Game = 'game';
    case Book = 'book';
    case Film = 'film';
}