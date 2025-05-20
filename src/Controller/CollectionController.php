<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Collection;
use App\Forms\CollectionForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CollectionController extends AbstractController
{
    #[Route('collection/{id}', name: 'collection-get', methods: ['GET'])]
    public function get(Collection $collection): Response
    {
        return $this->render('collection.html.twig', [
            'collection' => $collection,
        ]);
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

    #[Route('collection/delete/{id}', 'collection_delete', methods: 'DELETE')]
    public function delete(Collection $collection, EntityManagerInterface $em): Response
    {
        $em->remove($collection);
        $em->flush();
        #TODO нужно допилить шаблон коллекций
        return $this->render('collection.html.twig');
    }
}
