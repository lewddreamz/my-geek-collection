<?php
declare(strict_types=1);
namespace App\Controller;
use App\Repository\CollectionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class IndexController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function showCollections(CollectionRepository $colRep): Response
    {
        $all = $colRep->findAll();
        return $this->render('index.html.twig', ['collections' => $all]);
    }
}