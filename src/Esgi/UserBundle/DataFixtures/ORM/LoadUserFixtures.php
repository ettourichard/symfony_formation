<?php

namespace Esgi\UserBundle\DataFixtures\ORM;

use Esgi\UserBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setSuperAdmin(true);
        $user->setPlainPassword('admin');
        $user->setEmail('admin@blog.fr');
        $user->setEnabled(true);

        $userManager->updateUser($user, true);

        $manager->persist($user);

        $i = 1;
        $faker = \Faker\Factory::create();

        while ($i <= 10) {
            $user = $userManager->createUser();
            $word = $faker->unique()->word;
            $user->setUsername($word.'-'.$i);
            //$user->setRoles(array('ROLE_USER'));
            $user->setPlainPassword($word);
            $user->setEmail($word.'@user.fr');
            $user->setEnabled(true);

            $userManager->updateUser($user, true);

            $manager->persist($user);

            $this->addReference('user-'.$i, $user);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}
