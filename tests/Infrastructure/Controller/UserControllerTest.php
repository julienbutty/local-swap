<?php

namespace App\Tests\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRegistrationForm()
    {
        $client = static::createClient();

        $client->request('GET', '/register');


        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('button', 'Créer');
    }
}