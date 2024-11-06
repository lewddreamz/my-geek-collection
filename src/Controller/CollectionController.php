<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Collection;
use App\Forms\CollectionForm;
use App\Repository\CollectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class CollectionController extends AbstractController
{
    #[Route('collection/{id}', name: 'collection-get', methods: ['GET'])]
    public function get(CollectionRepository $cRep, int $id): Response
    {
        $collection = $cRep->find($id);
        if (!is_null($collection)) {
            return $this->render('collection.html.twig', [
                'collection' => $collection,
            ]);
        } else {
            throw new NotFoundHttpException("No collection with id $id");
        }
    }

    #[Route('collection/create', name: 'collection-create', methods: 'POST')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager): Response
    {
        $collection = new Collection();
        $form = $this->createForm(CollectionForm::class, $collection);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $collection = $form->getData();
                $entityManager->persist($collection);
                $entityManager->flush();
            } else {
                $formErrors = $form->getErrors();
                $this->redirectToRoute('error', ['errors' => $formErrors]);
            }
        }
        return $this->redirectToRoute('index');
    }

    #[Route('collection/delete', 'collection_delete', methods: 'DELETE')]
    public function delete(): Response
    {
        return $this->redirectToRoute('index');
    }
}
