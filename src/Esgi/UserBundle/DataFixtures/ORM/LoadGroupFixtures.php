<?php

namespace Esgi\UserBundle\DataFixtures\ORM;

use Esgi\UserBundle\Entity\Group;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadGroupFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function load(ObjectManager $manager)
    {
        $groupAdmin = new Group('Administrateurs');
        $groupMod = new Group('Modérateurs');
        $groupUser = new Group('Utilisateurs');

        $groupAdmin->setRoles(array('ROLE_SUPER_ADMIN'));

        //$groupMod->setRoles(array('ROLE_SUPER_ADMIN'));

        //$groupUser->setRoles(array('ROLE_SUPER_ADMIN'));


        $manager->persist($groupAdmin);
        $manager->persist($groupMod);
        $manager->persist($groupUser);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
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
