<?php

namespace Esgi\BlogBundle\DataFixtures\ORM;

use Esgi\BlogBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;


class LoadCommentFixtures extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    function load(ObjectManager $manager)
    {
        $i = 1;

        while($i <= 30) 
        {
            $comment = new Comment();
            $comment->setText('Texte du commentaire n°' . $i);

            $rand = rand(1, 20);
            $comment->setPost($this->getReference('post-' . $rand));
            $manager->persist($comment);

            $i++;
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}