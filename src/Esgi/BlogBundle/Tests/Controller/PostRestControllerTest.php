<?php

namespace Esgi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostRestControllerTest extends WebTestCase
{
    public function testGetPosts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/posts');
        $data = json_decode($client->getResponse()->getContent(), true);
        
        $this->assertTrue(isset($data[0]['id']));
    }
}
