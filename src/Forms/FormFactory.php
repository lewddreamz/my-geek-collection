<?php
declare(strict_types=1);
namespace App\Forms;

use App\Enums\CollectionTypes;
class FormFactory
{
    /**
     * 
     * @param \App\Enums\CollectionTypes $type
     * @return string
     */
    public static function getEntryFormClass(CollectionTypes $type): string
    {
        return match($type) {
            CollectionTypes::Film => FilmEntryForm::class
        };
    }
}