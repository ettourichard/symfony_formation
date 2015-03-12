<?php

namespace Esgi\BlogBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    public function findAllByPost($id)
    {
        return $this->createQueryBuilder('c')
            ->where('c.post = :post_id')
            ->orderBy('c.createdAt', 'DESC')
            ->setParameter('post_id', $id)
            ->getQuery()
            ->getResult();
    }
}
