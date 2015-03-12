<?php

namespace Esgi\BlogBundle\DataFixtures\ORM;

use Esgi\BlogBundle\Entity\Post;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadPostFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        $faker = \Faker\Factory::create();

        while ($i <= 100) {
            $post = new Post();
            $post->setTitle($faker->word);
            $post->setBody($faker->text($maxNbChars = 400));
            $post->setIsPublished($i%2);
            $post->setActiveComment(true);

            $rand = rand(1, 10);
            $post->setCategory($this->getReference('category-'.$rand));
            $manager->persist($post);

            $this->addReference('post-'.$i, $post);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
