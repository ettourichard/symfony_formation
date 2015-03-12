<?php

namespace Esgi\BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testBlog()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog');

        $nb = $crawler->filter('html:contains("Articles")')->count();
        
        $this->assertTrue($nb > 0);

        $crawler = $client->request('GET', '/blog?page=1');

        $nb = $crawler->filter('html:contains("Articles")')->count();
        
        $this->assertTrue($nb > 0);
    }

    public function testArticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/article/enim');

        $nb = $crawler->filter('html:contains("Comments")')->count();
        
        $this->assertTrue($nb > 0);
    }

    public function testSearch()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/blog/search', array('text' => 'el'));

        $nb = $crawler->filter('html:contains("Recherche")')->count();
        
        $this->assertTrue($nb > 0);
    }
}
