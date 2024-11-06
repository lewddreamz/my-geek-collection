<?php

declare(strict_types=1);

namespace App\Controller;

use App\Forms\SearchForm;
use App\Repository\CollectionRepository;
use App\Service\Api\Search;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class SearchController extends AbstractController
{
    #[Route('search-title', name: 'findByTitle')]
    public function findByTitle(
        #[MapQueryParameter] string $title,
        #[MapQueryParameter] string $api,
        CollectionRepository $repository,
        Search $search,
        SerializerInterface $serializer): Response
    {
        $search->setApi($api);
        $results = $search->findByTitle($title);
        $arr = [];
        foreach ($results as $result) {
            $arr[] = ['object' => $result,
                'serialized' => $serializer->serialize($result, 'json'),
            ];
        }
        $collections = $repository->findAll();

        return $this->render('search_result.html.twig', [
            'results' => $arr,
            'collections' => $collections,
        ]);
    }

    #[Route('search', name: 'search')]
    public function index(FormFactoryInterface $factory)
    {
        $searchForm = $factory->createNamed('', SearchForm::class, null, [
            'action' => $this->generateUrl('findByTitle'),
            'method' => 'GET',
        ]);

        return $this->render('search_index.html.twig', [
            'searchForm' => $searchForm,
        ]);
    }
}
