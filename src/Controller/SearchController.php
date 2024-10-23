<?php
declare(strict_types=1);
namespace App\Controller;
use App\Service\Api\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
class SearchController extends AbstractController
{
    #[Route('search', name: 'findByTitle')]
    public function findByTitle(
    #[MapQueryParameter] string $title,
    #[MapQueryParameter] string $api,
    Search $search)
    {
        $search->setApi($api);
        $results = $search->findByTitle($title);
        return $this->render('search_result.html.twig', ['results' => $results]);
    }
    #[Route('search', name: "search")]
    public function index()
    {
        return $this->render('search_index.html.twig');
    }

   
}