<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'registration', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('registration/index.html.twig', []);
    }

    #[Route('/registration', name: 'registration-new', methods: ['POST'])]
    public function register(UserPasswordHasherInterface $passwordHasher,
        //        #[MapRequestPayload] string $password,
        //        #[MapRequestPayload] string $email,
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator): Response
    {
        $payload = $request->request->all();
        $email = $payload['email'];
        $password = $payload['password'];
        $user = new User();
        $user->setEmail($email);
        $hashed = $passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashed);
        $errors = $validator->validate($user);
        if (0 === count($errors)) {
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('index');
        } else {
            return $this->redirectToRoute('error', ['error' => (string) $errors]);
        }
    }
}
