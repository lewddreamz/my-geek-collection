<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ErrorController extends AbstractController
{
    #[Route('/error/{error}', name: 'error')]
    public function index(string $error): Response
    {
        return $this->render('error/index.html.twig', [
            'error' => $error,
        ]);
    }
}
