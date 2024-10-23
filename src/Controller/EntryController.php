<?php
declare(strict_types=1);
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
class EntryController extends AbstractController
{
    #[Route('entry/add', 'addEntry', methods: 'POST')]
    public function add()
    {}
}