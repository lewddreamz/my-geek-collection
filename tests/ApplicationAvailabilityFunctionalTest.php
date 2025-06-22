<?php

declare(strict_types=1);

namespace App\Tests;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testAvailability($url): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        // Request a specific page
        $crawler = $client->request('GET', $url);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
    }

    public function testVisitWhileLoggedIn(): void
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneByEmail('test@email.com');
        $client->loginUser($user);

        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Добавить новую коллекцию');
    }

    public function urlProvider(): \Generator
    {
//        yield ['/'];
//        yield ['/collection/{id}'];
//        yield ['/collection/create'];
//        yield ['/collection/delete'];
//        yield ['/entry/add'];
//        yield ['/error/{error}'];
        yield ['/login'];
        yield ['/registration'];
//        yield ['/search-title'];
//        yield ['/search'];
    }
}
