<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NavigateControllerTest extends WebTestCase
{
    public function testImpressum()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/impressum');
    }

}
