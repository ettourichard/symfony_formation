<?php

namespace Esgi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testBlog()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'fr/blog');

        $nb = $crawler->filter('html:contains("Home")')->count();

        $this->assertTrue($nb > 0);

        $crawler = $client->request('GET', 'fr/blog?page=2');

        $nb = $crawler->filter('html:contains("Home")')->count();

        $this->assertTrue($nb > 0);
    }

    public function testSearch()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', 'fr/blog/search', array('text' => 'el'));

        $nb = $crawler->filter('html:contains("Recherche")')->count();

        $this->assertTrue($nb > 0);
    }
}
