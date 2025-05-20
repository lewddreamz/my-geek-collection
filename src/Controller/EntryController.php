<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Entry;
use App\Entity\FilmEntry;
use App\Repository\CollectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntryController extends AbstractController
{
    #[Route('entry/add', 'entry-add', methods: ['POST'])]
    public function add(EntityManagerInterface $em,
        Request $request,
        CollectionRepository $collectionRepository,
        ValidatorInterface $validator): Response
    {

        $serialized = $request->request->get('serialized');
        $collectionId = $request->request->get('collection_id');
        $class = $request->request->get('class');
        $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer(propertyTypeExtractor: new ReflectionExtractor())], [new JsonEncoder()]);
        $entry = $serializer->deserialize($serialized, $class, 'json');

        $entry->setCollection($collectionRepository->find($collectionId));
        $entry->setCreatedAt(new \DateTimeImmutable());

        $errors = $validator->validate($entry);
        if (count($errors) > 0) {
            $errorStr = (string) $errors;

            return $this->redirectToRoute('error', ['error' => $errorStr]);
        }
        $em->persist($entry);
        $em->flush();

        return $this->redirectToRoute('collection-get', ['id' => $collectionId]);

    }
}
