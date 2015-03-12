<?php

namespace Esgi\BlogBundle\DataFixtures\ORM;

use Esgi\BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;

class LoadCategoryFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $i = 1;
        $faker = \Faker\Factory::create();

        while ($i <= 10) {
            $category = new Category();
            $category->setName($faker->word);

            $manager->persist($category);
            $this->addReference('category-'.$i, $category);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
