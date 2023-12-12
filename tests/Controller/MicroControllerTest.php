<?php

namespace Malefici\TestCi\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MicroControllerTest extends WebTestCase
{
    public function testRandom(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/random/1000');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Hello, user!');
    }
}