<?php
declare(strict_types=1);
namespace App\Controller;
use App\Entity\Collection;
use App\Enums\CollectionTypes;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
class CollectionController extends AbstractController
{
    #[Route('collection/create', name: 'collection_create', methods: "POST")]
    public function create(
        ##[MapRequestPayload(type: Collection::class)] array $collectionArray,
        \Symfony\Component\HttpFoundation\Request $request,
        EntityManagerInterface $entityManager)
    {
        $collectionArray = $request->request->all();
        $collectionArray['entryType'] = $collectionArray['type'];
        $type = CollectionTypes::Book;
        $collection = new Collection();
        $collection->fill($collectionArray);
        $entityManager->persist($collection);
        $entityManager->flush();
        return new Response('Saved collection ' . $collection->getName());
    }
    #[Route('collection/delete', 'collection_delete', methods: "DELETE")]
    public function delete()
    {

    }
}